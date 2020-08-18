<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProdutoCadastrado extends Notification
{
    use Queueable;

    private $produto;
    private $loja;

    //private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($produto, $loja)
    {
        $this->produto = $produto;
        $this->loja = $loja;
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
        return (new MailMessage)
            ->subject("Produto  cadastrado na loja {$this->loja}")
            ->line("O produto {$this->produto} foi cadastrado com sucesso.");
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
