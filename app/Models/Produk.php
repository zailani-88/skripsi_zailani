<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['bahan_baku_id', 'nama_produk', 'deskripsi', 'harga_dasar', 'satuan', 'gambar'];

    public static function satuanOptions(): array
    {
        return [
            'm' => [
                'label' => 'Meter',
                'singkat' => 'm',
                'harga_suffix' => '/m²',
                'tipe' => 'area',
                'step' => '0.01',
                'placeholder' => '0.00',
            ],
            'mm' => [
                'label' => 'Milimeter',
                'singkat' => 'mm',
                'harga_suffix' => '/m²',
                'tipe' => 'area',
                'step' => '1',
                'placeholder' => '0',
            ],
            'cm' => [
                'label' => 'Centimeter',
                'singkat' => 'cm',
                'harga_suffix' => '/m²',
                'tipe' => 'area',
                'step' => '0.1',
                'placeholder' => '0.0',
            ],
            'pcs' => [
                'label' => 'Pcs / Lembar',
                'singkat' => 'pcs',
                'harga_suffix' => '/pcs',
                'tipe' => 'piece',
                'step' => '1',
                'placeholder' => '1',
            ],
        ];
    }

    public function getSatuanConfig(): array
    {
        return self::satuanOptions()[$this->satuan ?? 'm'] ?? self::satuanOptions()['m'];
    }

    public function getSatuanLabelAttribute(): string
    {
        return $this->getSatuanConfig()['label'];
    }

    public function getSatuanSingkatAttribute(): string
    {
        return $this->getSatuanConfig()['singkat'];
    }

    public function getHargaSuffixAttribute(): string
    {
        return $this->getSatuanConfig()['harga_suffix'];
    }

    public function isPerPiece(): bool
    {
        return ($this->satuan ?? 'm') === 'pcs';
    }

    public function isAreaBased(): bool
    {
        return !$this->isPerPiece();
    }

    public function convertToMeter(float $value): float
    {
        return match ($this->satuan ?? 'm') {
            'mm' => $value / 1000,
            'cm' => $value / 100,
            default => $value,
        };
    }

    public function calculateSubtotal(float $panjang, float $lebar, int $jumlah): float
    {
        if ($this->isPerPiece()) {
            return $this->harga_dasar * $jumlah;
        }

        $p = $this->convertToMeter($panjang);
        $l = $this->convertToMeter($lebar);

        return $p * $l * $this->harga_dasar * $jumlah;
    }

    public function formatUkuran($panjang, $lebar, $jumlah = null): string
    {
        if ($this->isPerPiece()) {
            return ($jumlah ?? 1) . ' Pcs';
        }

        $s = $this->satuan_singkat;

        return "{$panjang}{$s} × {$lebar}{$s}";
    }

    public function bahanBaku()
    {
        return $this->belongsToMany(BahanBaku::class, 'produk_bahan')
            ->withPivot('jumlah_digunakan', 'tipe_pengurangan');
    }
}
