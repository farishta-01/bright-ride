<?php

namespace App\Mail;

use App\Models\Appointment;
use App\Models\Car;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $car;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->car = Car::with('brand')->where('id', $appointment->car_id)->first();
    }

    public function build()
    {
        return $this->view('emails.appointment-confirmation')
            ->with([
                'appointment' => $this->appointment,
                'car' => $this->car,
            ]);
    }
}
