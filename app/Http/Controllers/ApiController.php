<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\PhotoAlbum;
use App\Spot;
use App\SpotImage;
use DB;
// import the Intervention Image Manager Class
use Image;


class ApiController extends Controller {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function addSpot(Request $request)
	{
                $all = $request->all();
                
                var_dump($all);
                
                $user_id = 1;
                
                $position = json_decode($all['position']);
                
                $spot = new Spot(['lon'=>(float)$position->longitude,
                        'lat'=>(float)$position->latitude,
                        'tags'=>$all['tags'],
                        'user'=>1]);


                $spot->save();

		$spot_id = $spot->id;
                
                
                $png_url = time().".jpg";
                
                mkdir(public_path().'/img/spots/'.$spot_id);
                
                $path = public_path().'/img/spots/'.$spot_id.'/' . $png_url;
                
                $img = $all['image'];
                
                $img = substr($img, strpos($img, ",")+1);
                
                $data = base64_decode($img);
                
                if(file_put_contents($path, $data)){
                    $spotImage = new SpotImage(['spot'=>$spot_id,'user'=>$user_id,'filename'=>$png_url]);
                    $spotImage->save();
                    $spot->image = $spotImage->id;
                    $spot->save();
                }
                
                return $spot_id;
	}
        
        public function getSpots(){
            return Spot::all();
        }

}