<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Jobs\FlushImageJob;
use Carbon\Carbon;
use Artisan;
use App\Jobs;
class NasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['images'] = Image::get();
        return view('home',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date_from = strtotime($request->get('start_date')); // Convert from date timestamp  
        $date_to   = strtotime($request->get('end_date')); // Convert to date timestamp  
        $dates     = array(); // Store Dates between start and end date
        $images    = array(); // Store Images to between start and end date

        // Dates between start and end date
        for ( $i = $date_from; $i <= $date_to; $i += 86400 ) 
        {  
            array_push( $dates,date("Y-m-d", $i ));  
        }
        //is submit button flush? == Yes
        if ($request->get('submitButton')=="flush") 
        {
            // Kill Other Events
            Image::query()->truncate();
            Jobs::query()->truncate();
            // Get all image to dates
            foreach ( $dates as $date ) 
            {
                // Take picture of $date's variable
                $data = $this->connectionNasaApi($date);

                foreach ( $data['photos'] as $value ) 
                {   
                    $images[]=array( 
                        'source_id' => $value['id'],
                        'img_src'=> $value['img_src'],
                        'earth_date' => $value['earth_date']
                     );
                $job = (new FlushImageJob($value['img_src'],$value['id']))->delay(Carbon::now()->addSeconds(3));
                    dispatch($job);

                } 

            }
        }
        else
        {
            Artisan::call('queue:work');
            foreach ( $dates as $date ) 
            {
                // Take picture of $date's variable
                $data = $this->connectionNasaApi($date);
                foreach ( $data['photos'] as $value ) 
                {   
                    $images[]=array( 
                        'source_id' => $value['id'],
                        'img_src'=> $value['img_src'],
                        'earth_date' => $value['earth_date']

                    );

                }

            }
        }

        $data['images'] = json_decode(json_encode($images));
        $data['start_date'] = $request->get('start_date');
        $data['end_date']   = $request->get('end_date');

        return view('home',$data);
    }

    /**
     * This Method is Connection api.nasa.gov 
     * @param date $value 
     * @return $result array format
     */
    public function connectionNasaApi($value){
        $url    = "https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?earth_date=".$value."&api_key=MhrWfv5hpboOKHNwmiMZwGUD49r8hX4nuE2Hd19H";
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $array  = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($array, true);

        return $result;
    }
}
