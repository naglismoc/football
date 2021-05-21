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
    .green{
        background-color: green;
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
                            <?php
                                $currentDay = date("d");
                            ?>
                            <td class="days opacity">Dienos</td>
                            @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $i++)
                            @if ($i < $currentDay)
                                <td class="opacity days">{{$i}}</td>
                            @else
                                <td class="days">{{$i}}</td>
                            @endif    
                           
                            @endfor
                        </tr>

                        {{-- antra eilute savaites dienos zodziais --}}
                        <tr>
                            <td class="sides opacity">H \ weekDay</td>
                            <?php  $weekends = []; ?>
                            @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $i++)
                                <?php
                                $day =substr("0".$i, -2);
                                $datetime = DateTime::createFromFormat('YmdHi', date('Y').date('m').$day.'0000');
                                if(date('N', strtotime( date("Y").date("m").$day) ) >= 6){
                                    $weekends[] = $i; 
                                }
                                ?>
                                 @if ($i < $currentDay)
                                 <td class="opacity sides">{{ $datetime->format('D')}}</td>
                                @else
                                <td class="sides">{{ $datetime->format('D')}}</td>
                                @endif  
                            @endfor
                       </tr>

                          {{-- darbo valandos --}}
                       @for ($i = 6; $i < 6+16; $i++)
                       <?php $time = substr("0".$i, -2).":00"; ?>
                            <tr>
                                <td class="sides">{{$time}}</td>

                                {{-- kalendoriaus turinys --}}
                                @for ($a = 1; $a <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $a++)
                                   <?php 
                                   $class = "";
                                   if(in_array($a+1, $weekends)){
                                    $class = "weekend";
                                   }   ?>

                                    @if ($a < $currentDay)
                                    {{-- {{dd($registrations)}} --}}
                                        @if (array_key_exists($a+1 ." ". $time, $registrations))
                                            <td class="opacity selected{{$class}}" value="{{$a+1 ." ". $time}}"></td> 
                                        @else
                                            <td class="opacity {{$class}}" value="{{$a+1 ." ". $time}}"></td> 
                                        @endif
                                    @else
                                        @if (array_key_exists($a+1 ." ". $time, $registrations))
                                            <td class="selected {{$class}}" value="{{$a+1 ." ". $time}}"></td>   
                                        @else
                                            <td class="selectable {{$class}}" value="{{$a+1 ." ". $time}}"></td>  
                                        @endif
                                   {{-- <td class="selectable {{$class}}" value="{{$a+1 ." ". $time}}"></td>    <div class="hover ">{{$a+1 ." ". $time}}</div> --}}
                                    @endif  
                                      

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

                    <form id="reg_form" action="{{route('reg.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="stadium_id" value="{{$stadium->id}}">
                        <input type="hidden" id="registrations" name="registrations" >
                        <button class="btn btn-primary" id="reg_btn" type="submit">rezervuoti laikus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
 @endsection
<script>
  
</script>