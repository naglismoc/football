<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Models\Registration;
use Illuminate\Http\Request;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \DB::statement("SET SQL_MODE=''"); 
        $cities = \DB::select('select city from stadia group by city order by city asc');
       
        if(isset($_GET['city']) 
            && $_GET['city'] != "0" 
            && $_GET['city'] != "1"){
            $stadia = Stadium::where('city','=',$_GET['city'])->get();
        }else{
        $stadia = Stadium::all();
        }
        // $stadia = Stadium::hydrate($stadia);
        return view('stadia.index',['stadia' => $stadia, 'cities' =>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('stadia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stadium = new Stadium();
        $stadium->name = $request->name;
        $stadium->city = $request->city;
        $stadium->address = $request->address;
        $stadium->save();
        return redirect()->route('stadia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stadium = Stadium::find($id);
        $registrations = Registration::where('stadium_id',$stadium->id)->get();
 

        return view('stadia.show',['stadium' => $stadium, 'registrations' =>$registrations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function edit(Stadium $stadium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stadium $stadium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stadium $stadium)
    {
        //
    }
}
