<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DatabaseBackupSuccessful extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $file_url,$subject;

    public function __construct($file_url="",$backup_type="cron")
    {
        $this->file_url=$file_url;
        if($backup_type=="cron"){
            $this->subject="Cron: Database Backup (" . Carbon::now()->format('m/d/Y h:i A') . ")";
        }
        else{
            $this->subject = "Database Backup (" . Carbon::now()->format('m/d/Y h:i A') . ")";
        }
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
            ->subject($this->subject)
            ->greeting('Hello,')
            ->line('Database backup successfully taken.')
            ->line("Please click below 'Download Backup' button to download.")
            ->action('Download Backup', $this->file_url);
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
