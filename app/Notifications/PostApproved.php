<?php

namespace App\Notifications;

use App\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostApproved extends Notification
{
    use Queueable;
    public $listing;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
            return (new MailMessage)->markdown('frontend.mail.listing.postapproved', ['url' => $this->listing->slug]);
//        return (new MailMessage)
////          ->subject('Your Subject') // it will use this class name if you don't specify
////          ->greeting('') // example: Dear Sir, Hello Madam, etc ...
//            ->level('info')// It is kind of email. Available options: info, success, error. Default: info
//            ->line('The introduction to the notification.')
//            ->action('Notification Action', $this->listing->slug)
//            ->line('Thank you for using our application!');
////          ->salutation('')  // example: best regards, thanks, etc ...
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
