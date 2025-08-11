<?php

namespace Modules\Auth\app\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $frontEndResetPasswordUrl = $this->generateFrontUrl($notifiable);

        return (new MailMessage)
            ->greeting("فروشگاه عسل کوهپایه")
            ->line('بازیابی رمز عبور')
            ->action('بازیابی رمز', $frontEndResetPasswordUrl)
            ->line('اگر درخواست عوض کردن رمز عبور خود را نداشتید این پیام را نادیده بگیرید')
            ->salutation("با احترام - عسل کوهپایه");
    }


    public function generateFrontUrl($token): string
    {
        return config('app.frontend_url') 
            . '/login/resetPassword?token=' . $this->token 
            . '&email=' . urlencode(request('email'));
    }

}
