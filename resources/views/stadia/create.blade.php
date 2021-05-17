@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PAVADINIMAS</div>
 
                <div class="card-body">
                    <form name="cityfilter" method="POST" action="{{route('stadia.store')}}">
                        @csrf
                        <h2>Užregistruokite stadioną</h2>
                        <div class="form-group">
                            <label><b>Stadiono pavadinimas</b></label>
                            <input type="text" class="form-control" name='name'>
                            {{-- <small class="form-text text-muted">Kažkoks parašymas.</small> --}}
                        </div>
                        <div class="form-group">
                            <label><b>Miestas</b></label>
                            <input type="text" class="form-control" name='city'>
                            {{-- <small class="form-text text-muted">Kažkoks parašymas.</small> --}}
                        </div>
                        <div class="form-group">
                            <label><b>Adresas</b></label>
                            <input type="text" class="form-control" name='address'>
                            {{-- <small class="form-text text-muted">Kažkoks parašymas.</small> --}}
                        </div>
                        <input class="btn btn-primary" type="submit" value="Registruoti">
                    </form> 
                </div>
            </div>
        </div>
    </div>
 </div>

    


  @endsection