<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build() {
        return $this->subject('Nouvelle reservation')
            ->from(config('mail.from.address'), config('mail.from.name')        )
            ->view('emails.reservation')
            ->to($this->reservation->user->email)
            ->view('reservation_notification');
    }
}
