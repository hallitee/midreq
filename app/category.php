<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\family;
class category extends Model
{
    //
	
	public $incrementing = false;
	
	protected $primaryKey = 'id';  
	
	
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id = ($model->family_id*100)+$model->id;
        });
    }	

		public function family(){
			
			return $this->belongsTo('App\family');
		}	
}
