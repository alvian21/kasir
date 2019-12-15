<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';

    protected $fillable = ['first_name','last_name','user_id','images','phone_number','location_informations'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
