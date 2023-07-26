<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = env('APP_URL') . "/password/reset/" . $this->token . "?email=" . $this->email;
        return (new MailMessage)
            ->subject(Lang::get('Recuperação de Senha'))
            ->greeting('Olá, ' . $this->name . "!")
            ->line(Lang::get('Esqueceu sua senha? Sem problemas, vamos resolver isso!'))
            ->action(Lang::get('Recuperar Senha'), $url)
            ->line(Lang::get('Esse link de recuperação de senha expira em :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Ignore este email caso não tenha solicitado uma recuperação de senha.'))
            ->salutation('Atenciosamente, ' . env('APP_NAME'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
