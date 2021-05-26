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
<?php
                                    $dayTmp =  date('Y')."-".date("m");

                                   
                                   if($month < 0){
                                   $dayTmp = date('Y-m', strtotime($dayTmp. ' - '. ( -1 * $month).' month'));
                                   }else{
                                    $dayTmp = date('Y-m', strtotime($dayTmp. ' + '.$month.' month'));
                                   }
                                 
                                //    echo strtotime($dayTmp. ' + '.$month.' month') - time();
?>

                <div class="card-header"><h3>{{$stadium->name}}  {{$dayTmp}}</h3>
                    <a class="btn btn-primary" href="{{route("stadia.show",["Stadium" => $stadium->id,"month" => $month-1]) }}"> atgal </a>
                    <a class="btn btn-primary" href="{{route("stadia.show",["Stadium" => $stadium->id,"month" => 0]) }}"> dabar </a>
                    <a class="btn btn-primary" href="{{route("stadia.show",["Stadium" => $stadium->id,"month" => $month+1]) }}"> pirmyn </a>
                   
                </div>
      
                <div class="card-body">
                    <table class="table">
                        {{-- pirma eilute, menesio dienos --}}
                        <tr>
                            <?php
                            $currentDay = date("d");

                                $currentTimestamp = time();
                            ?>
                            <td class="days opacity">Dienos</td>
                            @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $i++)
                                {{-- @if ($i < $currentDay) --}}
                                @if(strtotime(date('Y')."-".date("m").'-'.$i.' 23:59:59 + '.$month.' month') - time() < 0)
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
                                 @if (strtotime(date('Y')."-".date("m").'-'.$i.' 23:59:59 + '.$month.' month') - time() < 0)
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
                                <td class="sides left">
                                    <span>{{$time}}</span>
                                    <br>
                                    {{-- <span>Jūsų laiku: {{$time}}</span> --}}
                                </td>

                                {{-- kalendoriaus turinys --}}
                                @for ($a = 1; $a <= cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")); $a++)
                                   <?php 
                                   $class = "";
                                   if(in_array($a+1, $weekends)){
                                    $class = "weekend";
                                   }  
                                   $dayTmp = date('Y')."-".date("m").'-'.$a." ". $time;
                                //    echo $dayTmp;
                                   ?>
                                    {{-- @if ($a < $currentDay) --}}
                                    @if(strtotime($dayTmp. ' + '.$month.' month') - time() < 0)
                                  {{-- dienos kurios praejo --}}
                                        @if (array_key_exists($a ." ". $time, $registrations))
                                            @if ($registrations[$a ." ". $time]['user_id'] == Auth::user()->id)
                                                <td class="opacity selected yours-old {{$class}}" value="{{$a ." ". $time}}"></td> 
                                            @else
                                                <td class="opacity selected{{$class}}" value="{{$a ." ". $time}}"></td> 
                                            @endif
                                        @else
                                            <td class="opacity {{$class}}" value="{{$a ." ". $time}}"></td> 
                                        @endif
                                    @else
                                    {{-- dienos kurios yra/bus --}}
                                    @if (array_key_exists($a ." ". $time, $registrations))
                                        @if ($registrations[$a ." ". $time]['user_id'] == Auth::user()->id)
                                        
                                            <td class="selected yours {{$class}}" value="{{$a ." ". $time}}"> 
                                                <form class="form-delete" action="{{route('reg.delete',$registrations[$a ." ". $time]['id'])}}" method="post">
                                                    @csrf
                                                    <button class="btn form-delete-btn" type="submit">X</button>
                                                </form>
                                                <div class="hover ">{{$a ." ". $time}}</div>
                                            </td>   
                                        @else
                                            <td class="selected {{$class}}" value="{{$a ." ". $time}}"> <div class="hover ">{{$a ." ". $time}}</div></td>   
                                        @endif
                                    @else
                                        <td class="selectable {{$class}}" value="{{$a ." ". $time}}"> <div class="hover ">{{$a ." ". $time}}</div></td>  
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
                        <input type="hidden" id="month" name="month" value= "{{$month}}" >
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