<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\category; 


class subcategory extends Model
{
    //
	public $incrementing = false;
	
	protected $primaryKey = 'id';  
	
	
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id = ($model->cat_id*100)+$model->id;
        });
    }	

		public function category(){
			
			return $this->belongsTo('App\category');
		}	
}
