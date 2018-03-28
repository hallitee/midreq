<?php

namespace App\Mail;
use Auth;
use App\User;
use App\req;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 public $req;
    public function __construct(req $b)
    {
        //
		$this->req = $b;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'helpdesk@esrnl.com';
		$name = 'MID CODE REQUEST';
		$subject = 'MID REQUEST';
        return $this->view('email.newreq')
					->from($address, $name)
					->subject($subject)->with(['req'=>$this->req]);
    }
}
