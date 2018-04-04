<?php

namespace App\Jobs;

use Auth;
use App\User;
use App\req;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\groupReq;
use Illuminate\Support\Facades\Mail;
use App\mail\NewRequestEmail;
use App\Config;

class SendNewRequestEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	 public $user, $req, $config;
    public function __construct(req $c, User $d, config $e)
    {
        //
		$this->user = $d;
		$this->req = $c;
		$this->config = $e;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       // echo "Success";
	   echo $this->config->creator;
		Mail::to($this->config->creator)->send(new NewRequestEmail($this->req, $this->user, $this->config));
    }
}
