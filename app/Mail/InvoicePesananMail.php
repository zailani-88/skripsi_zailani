<?php

namespace App\Mail;

use App\Models\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoicePesananMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pesanan;

    public function __construct(Pesanan $pesanan)
    {
        $this->pesanan = $pesanan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Pesanan - ' . $this->pesanan->nomor_invoice,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice_pesanan',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}