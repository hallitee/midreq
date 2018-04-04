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

class NewRequestEmail extends Mailable
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
		$cemail = [];
			if($this->conf->hod!=null || $this->conf->hod!=""){
				//array_push($cemail, $this->copi->copi);
				$cemail = preg_split("/[;,\s]+/", $this->conf->hod);
			}		
        $address = 'helpdesk@esrnl.com';
		$name = 'MID CODE REQUEST';
		$subject = 'NEW MID REQUEST';
        return $this->view('email.newreq')
					->cc($cemail)
					->from($address, $name)
					->subject($subject)->with(['req'=>$this->req, 'user'=>$this->user]);
    }
}
