<?php

namespace App;
use App\group;
use Illuminate\Database\Eloquent\Model;

class family extends Model
{
    //
	public $incrementing = false;
	
	protected $primaryKey = 'id';  
	
	
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id = ($model->group_id*100)+$model->id;
        });
    }	    

		
		public function group(){
			
			return $this->belongsTo('App\group');
		}
}
