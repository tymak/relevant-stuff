@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

                @if ($profil == 'superuser')
                <nav class="navigace">
                <div class="col justify-content-between">
                    <a href="#flats">Byty</a>
                    <a href="#residents">Obyvatelé</a>
                </div>
                </nav>
                @endif

            @if ($profil == "superuser")
            <div class="card">
                    <div class="card-header"><p>Byty</p></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>    
                        @endif               


                        <div class="card" id="flats">
                                <div class="card-header"><p>Registrace bytu</p></div>
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form action="/flat" method="post" enctype="multipart/form-data">
                                    @csrf
            
                                    
                                    <input type="hidden" name="building_id" value="{{$building->id}}"><br>
            
                                    <label for="number">Číslo bytu:</label>
                                    <input type="number" name="number" value="{{$last_flat_number + 1}}" placeholder="poslední číslo je: {{$last_flat_number}}"><br>
                                    
            
                                    <label for="floor">Patro:</label>
                                    <input type="number" name="floor"  max="{{$building->floors_above_ground}}" min="{{0 - $building->floors_bellow_ground}}"><br>
                                    
                                    <label for="residential">Bytová jednotka:</label>
                                    <select name="residential">
                                                <option value="1">Ano</option>
                                                <option value="0">Ne</option>
                                        </select><br>
            
                                    <input type="submit" value="Registrovat" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>


                        @if (is_null($flats))
                            <h3>Žádné byty.</h3><br> 
                        @else
                            @foreach ($flats as $flat)
                            <div class="card">
                                    <form action="/su/edit/flat/{{$flat->id}}" method="post">
                                        @csrf
                                    <div class="card-header"><p>Číslo bytu: <input type="number" name="number" value="{{$flat->number}}"></p><p>ID: {{$flat->id}}</p></div>
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <div class="row justify-content-around"><label>Patro: <input type="number" name="floor" value="{{$flat->floor}}"  max="{{$building->floors_above_ground}}" min="{{0 - $building->floors_bellow_ground}}"></label></div>
                                        <input type="hidden" name="building_id" value="{{$building->id}}"><br>
                                        <div class="row justify-content-around"><label>Bytová jednotka: 
                                            <select name="residential" value="{{$flat->residential}}">
                                                    @if ($flat->residential === 1)
                                                        <option value="1" selected>Ano</option>
                                                    @else
                                                        <option value="1">Ano</option>
                                                    @endif
                                                        
                                                    @if ($flat->residential === 0)
                                                        <option value="0" selected>Ne</option>
                                                    @else
                                                        <option value="0">Ne</option>
                                                    @endif
                                                </select><br>
                                            </label></div>
                                        <div class="row justify-content-around">
                                                <div class="row justify-content-left"><input type="submit" value="Uložit změny" class="btn btn-primary"></div>
                                            </form>  
                                                <form action="/su/delete/flat/{{$flat->id}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="building_id" value="{{$building->id}}"><br>
                                                    <input type="submit" value="Smazat" class="btn btn-danger">
                                                </form>    
                                                </div>
                                    </div>
                                </div>                            
                           @endforeach
                        @endif
                    </div>
                </div>
            @endif




            @if ($profil == "superuser")
            <div class="card">
                    <div class="card-header"><p>Obyvatelé</p></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>    
                        @endif               

                        <div class="card">
                                <div class="card-header" id="residents"><p>Registrace obyvatele</p></div>
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form action="/resident" method="post" enctype="multipart/form-data">   {{-- Formulář pro registraci obyvatele       Zpracovává ResidentController@store --}}
                                    @csrf
                                    <label for="user_id"></label>
                                    <select name="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                        @endforeach
                                    </select><br>
                                    
                                    <label for="flat_id"></label>
                                    <select name="flat_id">
                                        @foreach ($flats as $flat)
                                        @if ($flat->residential == 1)
                                        <option value="{{$flat->id}}">patro: {{$flat->floor}} byt: {{$flat->number}}</option>       {{-- Výběr z bytových jednotek --}}
                                        @endif
                                        @endforeach
                                    </select><br>
            
                                    <input type="hidden" name="building_id" value="{{$building->id}}">
            
                                    <label for="begining_of_first_rent">Začátek prvního nájemního obdobý</label>
                                    <input type="date" name="begining_of_first_rent"><br>
            
                                    <label for="begining_of_current_rent">Začátek aktuálního nájemního obdobý</label>
                                    <input type="date" name="begining_of_current_rent"><br>
            
                                    <label for="contract_id">Smlouva</label>
                                    <select name="contract_id">
                                        @foreach ($rentcontracts as $contract)
                                            <option value="{{$contract->id}}">{{$contract->name}}</option>
                                        @endforeach
                                    </select><br>
                                    
                                    {{-- @if ($contract == 2) --}}  {{-- If bude v reaktu --}}
                                    <label for="end_of_current_rent">Konec aktuálního nájemního obdobý</label>
                                    <input type="date" name="end_of_current_rent"><br>
                                    {{-- @endif --}}
            
                                    <label for="number_of_residents">Počet osob</label>
                                    <input type="number" name="number_of_residents"><br>
            
                                    <label for="rental">Nájemné (kč)</label>
                                    <input type="number" name="rental"><br>
            
                                    <label for="file">Nájemní smlouva (.pdf)</label>
                                    <input type="file" name="file"><br>
            
                                    <input type="submit" value="Registrovat" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>     
                            
                            

                            @if (is_null($residents))
                            <h3>Žádné byty.</h3><br> 
                        @else
                            @foreach ($residents as $resident)
                            @foreach ($users as $user)
                                @if ($resident->user_id === $user->id)
                            <div class="card">
                                    <form action="/su/edit/resident/{{$resident->id}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <div class="card-header"><p>{{$user->first_name}} {{$user->last_name}}</p><p>ID: {{$resident->id}}</p></div>
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <div class="row justify-content-around"><label>Byt:
                                                <select name="flat_id">
                                                        @foreach ($flats as $flat)
                                                        @if ($resident->flat_id === $flat->id)
                                                        <option value="{{$flat->id}}" selected>patro: {{$flat->floor}} byt: {{$flat->number}}</option>       {{-- Výběr z bytových jednotek --}}
                                                        @else
                                                        <option value="{{$flat->id}}">patro: {{$flat->floor}} byt: {{$flat->number}}</option> 
                                                        @endif
                                                        @endforeach
                                                    </select><br>    
                                        </label></div>
                                    <div class="row justify-content-around"><label for="begining_of_first_rent">Začátek prvního nájemního obdobý: <input type="date" name="begining_of_first_rent" value="{{$resident->begining_of_first_rent}}"><br></label></div>
                                    <div class="row justify-content-around"><label for="begining_of_current_rent">Začátek aktuálního nájemního obdobý: <input type="date" name="begining_of_current_rent" value="{{$resident->begining_of_current_rent}}"><br></label></div>
                                    <div class="row justify-content-around"><label for="contract_id">Smlouva: 
                                        <select name="contract_id">
                                            @foreach ($rentcontracts as $contract)
                                            @if ($resident->contract_id === $contract->id)
                                            <option value="{{$contract->id}}" selected>{{$contract->name}}</option>
                                            @else
                                            <option value="{{$contract->id}}">{{$contract->name}}</option>
                                            @endif
                                                
                                            @endforeach
                                        </select></label></div>
                                        @if ($resident->contract_id == 2)
                                        <div class="row justify-content-around"><label for="end_of_current_rent">Konec aktuálního nájemního obdobý: <input type="date" name="end_of_current_rent" value="{{$resident->end_of_current_rent}}"></label></div>    
                                        @endif

                                        <div class="row justify-content-around"><label for="number_of_residents">Počet obyvatel: <input type="number" name="number_of_residents" value="{{$resident->number_of_residents}}"></label></div>
                                        <div class="row justify-content-around"><label for="rental">Nájemné: <input type="number" name="rental" value="{{$resident->rental}}"> kč</label></div>
                                        <div class="row justify-content-around"><label for="file">Nájemní smlouva: <input type="file" name="file"></label></div>
                                    
                                        
                                        <input type="hidden" name="building_id" value="{{$building->id}}"><br>
                                        <div class="row justify-content-around">
                                                <div class="row justify-content-left"><input type="submit" value="Uložit změny" class="btn btn-primary"></div>
                                            </form>  
                                                <form action="/su/delete/resident/{{$resident->id}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="building_id" value="{{$building->id}}"><br>
                                                    <input type="submit" value="Smazat" class="btn btn-danger">
                                                </form>    
                                                </div>
                                    </div>
                                </div>
                            @endif
                            @endforeach                        
                           @endforeach
                        @endif


                    
            @endif
        </div>
    </div>
</div>
@endsection