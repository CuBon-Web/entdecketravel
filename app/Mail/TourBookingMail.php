<?php

namespace App\Mail;

use App\models\BillTour;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TourBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\models\BillTour */
    public $bill;

    /** @var string */
    public $tourTitle;

    /** @var string */
    public $servicesSummary;

    /** @var bool */
    public $customerCopy;

    public function __construct(BillTour $bill, string $tourTitle, bool $customerCopy = false)
    {
        $this->bill = $bill;
        $this->tourTitle = $tourTitle;
        $this->customerCopy = $customerCopy;
        $raw = (string) ($bill->service_id ?? '');
        $decoded = json_decode($raw, true);
        $this->servicesSummary = (json_last_error() === JSON_ERROR_NONE && is_array($decoded))
            ? implode(', ', $decoded)
            : $raw;
    }

    public function build()
    {
        if ($this->customerCopy) {
            return $this->subject('[Entdecken Travel] Confirmation of Receipt of Tour Booking Request')
                ->view('emails.tour_booking_customer');
        }

        $mailable = $this->subject('[Entdecken Travel] New Tour Booking Request #' . $this->bill->id)
            ->view('emails.tour_booking_admin');

        $replyEmail = trim((string) ($this->bill->email ?? ''));
        if ($replyEmail !== '' && filter_var($replyEmail, FILTER_VALIDATE_EMAIL)) {
            $replyName = trim((string) ($this->bill->name ?? ''));
            $mailable->replyTo($replyEmail, $replyName !== '' ? $replyName : $replyEmail);
        }

        return $mailable;
    }
}
