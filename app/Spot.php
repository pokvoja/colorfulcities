<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SpotImage;

class Spot extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lat','lon','user','image'];

   
    protected $dates = ['created_at', 'updated_at'];
    
    
    /**
     * Get the Locations
     *
     * @return obj
     */
    public function getImagesAttribute()
    {
        return SpotImage::where('spot', $this->id)->orderBy('created_at', 'desc')->get();
    }
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['images'];
}
