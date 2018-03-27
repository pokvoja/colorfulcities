<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotImage extends Model
{
	
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['spot','user','filename'];

   
    protected $dates = ['created_at', 'updated_at'];
}
