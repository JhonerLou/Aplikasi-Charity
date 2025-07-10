<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Donation;

class DonationReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        return $this->subject('Donation Receipt')
                    ->view('emails.donation_receipt');
    }

    protected function generatePDF()
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('donation.invoice', [
            'donation' => $this->donation
        ]);
        return $pdf->output();
    }
}
