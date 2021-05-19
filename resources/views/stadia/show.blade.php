@extends('layouts.app')
<style>
    .card-body > .table >  tbody > tr> td{
        width: 50px;
        border: solid 1px grey;
        font-size: 12px;
        padding: 0;
        height:40px;
    }
    .weekend{
        background-color: rgb(201, 193, 193);
    }
    .card-body > .table >  tbody > tr> td:first-of-type{
        width: 80px;
    }

   
    table {
  /* border: 1px solid black; */
  table-layout: fixed;
  width: 1500px;
}
</style>
@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>{{$stadium->name}}</h3>

                    
                </div>
      
                <div class="card-body">
                    <table class="table">
                        {{-- pirma eilute, menesio dienos --}}
                        <tr>
                            <td></td>
                            @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $i++)
                                <td>{{$i}}</td>
                            @endfor
                        </tr>
                        {{-- antra eilute savaites dienos zodziais --}}
                        <tr>
                            <td></td>
                            <?php  $weekends = []; ?>
                            @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $i++)
                                <?php
                                $day =substr("0".$i, -2);
                                $datetime = DateTime::createFromFormat('YmdHi', date('Y').date('m').$day.'0000');
                                if(date('N', strtotime( date("Y").date("m").$day) ) >= 6){
                                    $weekends[] = $i; 
                                }
                                ?>
                                <td>{{ $datetime->format('D')}}</td>
                            @endfor
                       </tr>
                          {{-- darbo valandos --}}
                       @for ($i = 6; $i < 6+16; $i++)
                            <tr>
                                <td>{{substr("0".$i, -2).":00"}}</td>
                                {{-- kalendoriaus turinys --}}
                                @for ($a = 0; $a <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $a++)
                                
                                   <?php 
                                   $class = "";
                                //    dd($weekends);
                                   if(in_array($a+1, $weekends)){
                                    $class = "weekend";
                                   } 
                                   ?>
                                   
                                   
                                        <td class="{{$class}}"></td> 
                                    
                                   
                                @endfor
                            </tr>
                       @endfor
                    
                        {{-- @foreach ($stadia as $stadium)
                            <tr>
                                <td>{{$stadium->name}}</td>
                                <td>{{$stadium->city}}</td>
                                <td>{{$stadium->address}}</td>
                                <td><a href="{{route('stadia.show',$stadium)}}">uzeiti</a></td>
                                
                              </tr>
                        @endforeach --}}
                        
                      </table>
                </div>
            </div>
        </div>
    </div>
 </div>
 @endsection
<script>
  
</script>