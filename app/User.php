<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','admin','company','approver', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $p = explode('@',$model->email);
			$q = explode('.', $p[1]);
			switch($q[0]){
				case "natural-prime":
				$model->company = 'NPRNL';
				break;
				case "esrnl":
				$model->company = 'ESRNL';
				break;
				case "primerafood-nigeria":
				$model->company = 'PFNL';
				break;	
				default :
				$model->company = '';
				break;					
			}
        });
    }	

		public function isAdmin(){
		
		return $this->admin;
	}
	
		public function isApprover(){
		
		return $this->approver;
	}	
	public function requests(){
		return $this->hasMany('App\req');
	}
}
