<?php

namespace App\Mail\Frontend\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactSeller extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $seller = User::find($this->request->seller);
        return $this->to($seller->email, $seller->name)
            ->view('frontend.mail.contact-seller')
            ->text('frontend.mail.contact-seller-text')
            ->subject(__('New Message From '.$request->name))
            ->from($request->email, $request->name)
            ->replyTo($request->email, $request->name);
    }
}
