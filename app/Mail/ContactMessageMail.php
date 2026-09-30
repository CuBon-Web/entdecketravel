<?php

namespace App\Mail;

use App\models\MessContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\models\MessContact */
    public $contact;

    /** @var bool */
    public $customerCopy;

    public function __construct(MessContact $contact, bool $customerCopy = false)
    {
        $this->contact = $contact;
        $this->customerCopy = $customerCopy;
    }

    public function build()
    {
        if ($this->customerCopy) {
            return $this->subject('[' . config('app.name') . '] Đã nhận tin nhắn liên hệ của bạn')
                ->view('emails.contact_message_customer');
        }

        $mailable = $this->subject('[' . config('app.name') . '] Liên hệ mới #' . $this->contact->id)
            ->view('emails.contact_message_admin');

        $replyEmail = trim((string) ($this->contact->email ?? ''));
        if ($replyEmail !== '' && filter_var($replyEmail, FILTER_VALIDATE_EMAIL)) {
            $replyName = trim((string) ($this->contact->name ?? ''));
            $mailable->replyTo($replyEmail, $replyName !== '' ? $replyName : $replyEmail);
        }

        return $mailable;
    }
}
