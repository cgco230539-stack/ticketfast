<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $ip;
    public string $userAgent;
    public string $loginTime;

    public function __construct(User $user, string $ip, string $userAgent, string $loginTime)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->loginTime = $loginTime;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo inicio de sesion en TicketFast',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.login-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}