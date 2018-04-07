<?php

namespace App\Mail;
use Auth;
use App\User;
use App\req;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\config;

class approvalNotifier extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	  public $req, $user, $conf;
    public function __construct(req $b,User $c,config $d)
    {
        //
		$this->req = $b;
		$this->user = $c;
		$this->conf = $d;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $address = 'helpdesk@esrnl.com';
		$name = 'MID CODE';
		$subject = 'CREATE NEW MID CODE';
        return $this->view('email.appreq')
					->cc($this->conf->hod)
					->from($address, $name)
					->subject($subject)->with(['req'=>$this->req, 'user'=>$this->user,'conf'=>$this->conf]);
    }
}
