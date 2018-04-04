<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\dbo.OITM_SP; 


class dbo.OITM_SP extends Model
{
	protected $connection = 'sqlsrv';
	
	protected $primarykey = 'ITEMCODE';
	
	protected $fillable = [
        'entitycode', 'itemcode', 'itemname','itemgroup','u_it_subcat', 'u_it_cat', 'u_it_fam', 'u_it_grp'
    ];
	//public $incrementing = false;
	
	//protected $primaryKey = 'id';  
	/*
	
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
		*/	
}
