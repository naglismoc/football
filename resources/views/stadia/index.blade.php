@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">PAVADINIMAS

                    
                </div>
                <div class="card-header">
                    <form id="cityfilter" action="{{route('stadia.index')}}" method="get">
                    <select name="city" id="cities">
                        <option value="0">pasirinkite miestą</option>
                        @foreach ($cities as $city)
                        <option value="{{$city->city}}">{{$city->city}}</option>
                        @endforeach
                      </select>
                </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                          <th>Stadiono pavadinimas</th>
                          <th>miestas</th>
                          <th>adresas</th>
                        </tr>
                     
                        @foreach ($stadia as $stadium)
                            <tr>
                                <td>{{$stadium->name}}</td>
                                <td>{{$stadium->city}}</td>
                                <td>{{$stadium->address}}</td>
                              </tr>
                        @endforeach
                        
                      </table>
                </div>
            </div>
        </div>
    </div>
 </div>
 @endsection
<script>
  
</script>