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
use App\Mail\approvalNotifier;
use App\Config;

class sendApprovalNotificationEmail implements ShouldQueue
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
		Mail::to($this->config->creator)->send(new approvalNotifier($this->req, $this->user, $this->config));
    }
}
