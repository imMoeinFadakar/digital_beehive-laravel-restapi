<?php

namespace Modules\Auth\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ValidationEmailNotification extends Notification
{
    use Queueable;

    public $code;
    /**
     * Create a new notification instance.
     */
      public function __construct(int $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        

        return (new MailMessage)
        ->greeting('فروشگاه عسل کوهپایه')
            ->subject('تأیید ایمیل')
            ->line('کد تایید شما:'. $this->code)
            ->line('اگر این درخواست را انجام نداده‌اید، این پیام را نادیده بگیرید.')
            ->salutation("با احترام - عسل کوهپایه");
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [];
    }
}
