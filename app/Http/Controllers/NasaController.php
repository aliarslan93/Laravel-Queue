<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       //
    }

    /**
     * This Method is Connection api.nasa.gov 
     * @param date $value 
     * @return $result array format
     */
    public function connectionNasaApi($value){
     //
    }
}
