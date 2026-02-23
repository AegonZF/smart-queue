<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountBlockedNotification extends Notification
{
    use Queueable;

    protected string $unlockUrl;

    public function __construct(string $unlockUrl)
    {
        $this->unlockUrl = $unlockUrl;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Cuenta bloqueada - SmartQueue')
            ->greeting('Hola')
            ->line('Tu cuenta ha sido bloqueada debido a 3 intentos fallidos de inicio de sesión.')
            ->line('Si fuiste tú, haz clic en el botón de abajo para desbloquear tu cuenta y volver a intentarlo.')
            ->action('Desbloquear mi cuenta', $this->unlockUrl)
            ->line('Si no fuiste tú, te recomendamos cambiar tu contraseña lo antes posible.')
            ->salutation('Saludos, SmartQueue');
    }
}
