<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Auth;
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //  dd(Auth::user()->id);

    // dd(date("M"));
      $registrations = explode(",",$request->registrations);
      for ($i=0; $i < count($registrations); $i++) { 
        //   dd(date('Y')."-".date("m").'-'. $registrations[$i]);
        $registration = new Registration();
        $registration->user_id = Auth::user()->id;
        $registration->stadium_id = $request->stadium_id;


        // $dayTmp =  date('Y')."-".date("m");
        // $dayTmp = date('Y-m', strtotime($dayTmp. ' + '.$month.' month'));
        $date = date('Y-m', strtotime(date('Y')."-".date('m'). ' + '.$request->month.' month'));

        $registration->registration_date =$date.'-'. $registrations[$i].":00";
        $registration->save();

      }

      return redirect()->back();
    //   dd($registrations);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        // dd(date("d"));
       $reg = Registration::find($id);

       $regTime = strtotime($reg->registration_date);
       $nowTime = (strtotime(date(DATE_ATOM)));
    //    dd( date('H',$regTime - $nowTime) -3 );

    //    if( explode(" ", date('m', strtotime($reg->registration_date))) != date('d') ){
    //     $reg->delete();
    //    }
    // echo $regTime - $nowTime."<br>";
    // echo date('h:m:s',$regTime - $nowTime);
// dd( ($regTime - $nowTime) / 3600 );
    if( ($regTime - $nowTime) / 3600 >= 24){
        $reg->delete();
    }
       return redirect()->back();

    }
}
