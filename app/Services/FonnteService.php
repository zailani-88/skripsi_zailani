<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected string $token;
    protected string $baseUrl;

    public function __construct()
    {
        $this->token = config('fonnte.token');
        $this->baseUrl = 'https://api.fonnte.com';
    }

    public function sendMessage(string $target, string $message): bool
    {
        if (empty($this->token)) {
            Log::warning('Fonnte token tidak dikonfigurasi');
            return false;
        }

        $phone = $this->formatPhone($target);
        if (!$phone) {
            Log::warning('Nomor telepon tidak valid: ' . $target);
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->baseUrl . '/send', [
                'target' => $phone,
                'message' => $message,
                'type' => 'text',
            ]);

            $body = $response->json();

            if ($response->successful() && ($body['status'] ?? false)) {
                Log::info('Fonnte WA berhasil dikirim ke: ' . $phone);
                return true;
            }

            Log::error('Fonnte gagal: ' . ($body['reason'] ?? 'Unknown error'));
            return false;
        } catch (\Exception $e) {
            Log::error('Fonnte exception: ' . $e->getMessage());
            return false;
        }
    }

    private function formatPhone(string $phone): ?string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) < 10 || strlen($phone) > 15) {
            return null;
        }

        if (substr($phone, 0, 2) === '08') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 1) === '8') {
            $phone = '62' . $phone;
        }

        return $phone;
    }
}
