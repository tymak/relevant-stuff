@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12">

            @if ($profil == 'owner' ||  $profil == 'administrator' || $profil == 'resident')
            <div class="card">
                <div class="card-header"><p>Nástěnka</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>    
                    @endif

                    @if (is_null($notices))
                        <h3>There is nothing here</h3><br> 
                    @else
                        @foreach ($notices as $notice)              {{-- Permanentní upozornění --}}
                        @if ($notice->permanent == 1)
                        
                        <div class="card-header"><h3><strong>{{$notice->text}}</strong></h3>
                    </div>
                        @endif
                        @endforeach
                        @foreach ($notices as $notice)
                        @if ($notice->permanent == 0)               {{-- Běžné upozornění ubíhající jako chat--}}
                        <div class="row justify-content-around">
                        <h3>{{$notice->text}}</h3>
                        @if ($profil === 'administrator')
                        <form action="su/delete/notice/{{$notice->id}}" method="post">
                            @csrf
                            <input type="submit" value="Smazat" class="btn btn-danger">
                        </form>    
                        @endif
                        <div>
                        @endif
                        @endforeach
                    
                    @endif
                    @if ($profil == 'administrator')            {{-- Zobrazí se pouze profilu "administrator" --}}
                    <form action="/notice" method="post">       {{-- Formulář pro přidání upozornění        Zpracovává NoticeController@store --}}
                            @csrf
                            <label for="notice">Zpráva</label>
                            <input type="text" name="notice">

                            <input type="hidden" name="noticeboard" value="{{$noticeboard->id}}">

                            <label for="text">Permanentní</label>
                            <input type="radio" name="permanent">

                            <input type="submit" value="Odeslat">
                        </form>
                    @endif
                </div>
            </div>
            @endif

            @if ($profil == 'owner' ||  $profil == 'administrator' || $profil == 'resident')
            <div class="card">
                <div class="card-header"><p>Chat</p><select>@foreach ($communities as $community)<option>{{$community->community_name}}</option>@endforeach</select></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    @if (is_null($chats[0]))
                    <h3>There is nothing here</h3><br>    
                    @else
                    @foreach ($chats[0] as $chat)
                    @foreach ($users as $user)
                    @if ($user->id == $chat->user_id)
                    <h3>{{$user->first_name}} {{$user->last_name}}</h3>
                    <div class="row justify-content-between"><h2>{{$chat->text}}</h2><img class="image" src="{{$chat->image}}"><br>
                    @if ($profil === 'administrator' || $user->id === $current_user->id)
                    <form action="su/delete/chat/{{$user->id}}" method="post">
                        @csrf
                        <input type="submit" value="Smazat" class="btn btn-danger">
                    </form>
                    @endif
                </div>
                    @endif
                    @endforeach
                    @endforeach
                    @endif
                    <form action="/chat" method="post">         {{-- Formulář pro přidání zprávy        Zpracovává ChatController@store --}}
                        @csrf
                        <label for="text">Zpráva</label>
                        <input type="text" name="text"><br>
                        <input type="hidden" name="community_id" value="{{$community->id}}">
                        <label for="text">Odkaz na obrázek</label>
                        <input type="url" name="image">

                        <input type="submit" value="Odeslat">
                    </form>
                </div>
            </div>
            @endif

            @if ($profil == 'resident' )                    {{-- Zobrazí se pouze profilu "resident" --}}
                <div class="card">
                    <div class="card-header"><p>Moje údaje</p></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4>Jméno: {{$current_user->first_name}} {{$current_user->last_name}}</h4><br>
                        <h4>Telefoní číslo: {{$current_user->phone_number}}</h4><br>
                        <h4>E-mail: {{$current_user->email}}</h4><br>
                        <h4>Nájemné: {{$resident->rental}} KČ</h4><br>
                        <h4>Smlouva: {{$contract->name}}</h4><br>
                        <h4>Začátek smlouvy: {{$date}}</h4><br>
                        @if ($resident->contract_id == 2)
                        <h4>Konec smlouvy: {{$resident->end_of_current_rent}}</h4><br>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><p>Moje Soubory</p></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/storage/contract/{{$file_id}}.pdf" target="_blank">Nájemní Smlouva</a>
                    </div>
                </div>
            @endif

            @if ($profil == 'administrator' )
            <div class="card">
                    <div class="card-header"><p>Registrace obyvatele</p></div>
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
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>       Výběr z uživatelů
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

                        <input type="hidden" name="building_id" value="{{$building}}">

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

                        <label for="file">Nájemní smlouva</label>
                        <input type="file" name="file"><br>

                        <input type="submit" value="Registrovat">
                        </form>
                    </div>
                </div>
            @endif

            @if ($profil == 'owner' ||  $profil == 'administrator')
            <div class="card">
                <div class="card-header"><p>Tato budova</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table>
                            <th>Budova</th>
                        <thead>
                            <th>Položka</th>
                            <th>Hodnota</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>Město</td>
                                <td>{{$this_building->city}}</td>
                            </tr>
                            <tr>
                                <td>Ulice</td>
                                <td>{{$this_building->street}}</td>
                            </tr>
                            <tr>
                                <td>Číslo popisné</td>
                                <td>{{$this_building->house_number}}</td>
                            </tr>
                            <tr>
                                <td>Počet podlaží</td>
                                <td>{{$this_building->floors_above_ground + $this_building->floors_bellow_ground}}</td>
                            </tr>
                            <tr>
                                <td>Vytápění</td>
                                <td>@if ($this_building->heating == 1)
                                    Ano
                                @else
                                    Ne
                                @endif</td>
                            </tr>
                            <tr>
                                <td>Výtah</td>
                                <td>{{$this_building->elevator}} (krát)</td>
                            </tr>

                            <tr>
                                <td>Vlastník</td>
                                <td>{{$this_building->owner_id}}</td>
                            </tr>
                        </tbody>
                        
                    </table>
                    
                    <table>
                        <th>Bytové jednotky</th>
                        <tbody>
                            @foreach ($flats as $flat)
                            @if ($flat->residential == 1)
                            <tr>
                                <td>Patro: {{$flat->floor}}</td>
                                <td>Číslo bytu: {{$flat->number}}</td>
                                <td>Obyvatel: 
                                        @foreach ($residents as $resid)
                                            @if ($resid->flat_id == $flat->id)
                                                <?php $r = DB::table('users')->where('id', '=', $resid->user_id)->first(); $name = "{$r->first_name} {$r->last_name}" ?>
                                                {{$name}}
                                            @endif
                                        @endforeach                                    
                                </td>
                            </tr>    
                            
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                    <table>
                        <th>Nebytové jednotky</th>
                        <tbody>
                            @foreach ($flats as $flat)
                            @if ($flat->residential == 0)
                            <tr>
                                <td>Patro: {{$flat->floor}}</td>
                                <td>Číslo bytu: {{$flat->number}}</td>
                                <td>Obyvatel:
                                    @foreach ($residents as $resid)
                                    @if ($resid->flat_id == $flat->id)
                                        <?php $r = DB::table('users')->where('id', '=', $resid->user_id)->first(); $name = "{$r->first_name} {$r->last_name}" ?>
                                        {{$name}}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if ($profil == 'owner' ||  $profil == 'administrator' || $profil == 'resident')
            <div class="card">
                <div class="card-header"><p>Pravidla domu</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p>{!!$rules!!}</p>
                    @if ($profil === 'administrator')
                    <form action="/updatebuilding" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="file">Textový soubor pravidel domu</label>
                        <input type="file" name="file"><br>
                        <input type="hidden" name="id" value="{{$building}}"><br>
                        <input type="submit" value="Upload">
                    </form>
                    @endif
                </div>
            </div>
            @endif

            @if ($profil == 'owner' ||  $profil == 'administrator')
            <div class="card">
                <div class="card-header"><p>Databáze Obyvatel</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    <table>
                        <th>Obyvatelé</th>
                        <tbody>
                            @foreach ($users as $user)
                            @foreach ($residents as $resident)
                                @if ($resident->user_id === $user->id)
                                <tr>
                                    <td>Jméno: {{$user->first_name}} {{$user->last_name}}</td>
                                    <td>Datum narození: {{$user->birth_date}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <table>
                        <th>Nájemní smlouvy</th>
                        <tbody>
                            @foreach ($users as $user)
                                @foreach ($residents as $resident)
                                @if ($user->id == $resident->user_id)
                                        <td><a href="/storage/contract/{{$resident->id}}.pdf" target="_blank"> {{$user->first_name}} {{$user->last_name}}</a></td>
                                    </tr>
                                @endif
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
            </div>
            @endif

            @if ($profil == 'superuser')
            <nav class="navigace">
            <div class="col justify-content-between">
                <a href="#users">Uživatelé</a>
                <a href="#buildings">Budovy</a>
                <a href="#owners">Vlastníci</a>
                <a href="#admins">Správci</a>
            </div>
            </nav>
            @endif

            @if ($profil == 'superuser')
            <div class="card">
                <div class="card-header"><p id="users">Uživatelé</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header"><p id="users">Registrace uživatele</p></div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                    <form action="/user" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="first_name">Jméno</label>
                        <input type="text" name="first_name"><br>

                        <label for="last_name">Příjmení</label>
                        <input type="text" name="last_name"><br>

                        <label for="birth_date">Datum narození</label>
                        <input type="date" name="birth_date"><br>
                        
                        <label for="phone_number">Telefoní číslo</label>
                        <input type="number" name="phone_number"><br>
                        
                        <label for="email">E-mail</label>
                        <input type="text" name="email"><br>

                        <label for="password">Heslo</label>
                        <input type="password" name="password"><br>

                        <input type="submit" value="Registrovat" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                    @foreach ($users as $user)
                    
                    <div class="card">
                            <form action="su/edit/user/{{$user->id}}" method="post">
                                @csrf
                            <div class="card-header"><input type="text" name="first_name" value="{{$user->first_name}}"><input type="text" name="last_name" value="{{$user->last_name}}"><label for="">ID: {{$user->id}}</label></div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            <div class="row justify-content-around"><label for="birth_date">Datum narození:</label><input type="date" name="birth_date" value="{{$user->birth_date}}"><br></div>
                            <div class="row justify-content-around"><label for="phone_number">Telefoní číslo:</label><input type="number" name="phone_number" value="{{$user->phone_number}}"><br></div>
                                <div class="row justify-content-around"><label for="email">Email:</label><input type="text" name="email" value="{{$user->email}}"><br></div>

                                <div class="row justify-content-around">

                                    <div class="row justify-content-left"><input type="submit" value="Uložit změny" class="btn btn-primary"></div>
                        </form>
                        <form action="su/delete/user/{{$user->id}}" method="post">          {{-- tlačítko na smazání --}}
                            @csrf
                            <input type="submit" value="Smazat" class="btn btn-danger">
                        </form>
                    </div>
                        </div>
                    </div>
                    @endforeach
                
                </div>
            </div>
            @endif

            
            @if ($profil == 'superuser')
            <div class="card">
                <div class="card-header"><p id="buildings">Budovy</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                            <div class="card-header"><p>Registrace Budovy</p></div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="/building" method="post" enctype="multipart/form-data">   {{-- Formulář pro registraci budovy       Zpracovává BuildingController@store --}}
                                @csrf
        
                                <label for="city">Město</label>
                                <input type="text" name="city"><br>
        
                                <label for="street">Ulice</label>
                                <input type="text" name="street"><br>
        
                                <label for="house_number">Číslo popisné</label>
                                <input type="number" name="house_number"><br>
                                
                                <label for="postal">Poštovní směrovací číslo</label>
                                <input type="number" name="postal"><br>
                                
                                <label for="construction_date">Datum výstavby</label>
                                <input type="date" name="construction_date"><br>
        
                                <label for="floors_above_ground">Počet nadzemních pater</label>
                                <input type="number" name="floors_above_ground"><br>
        
                                <label for="floors_bellow_ground">Počet nadzemních pater</label>
                                <input type="number" name="floors_bellow_ground"><br>
        
                                <label for="heating">Vytápění</label>
                                <input type="checkbox" name="heating"><br>
        
                                <label for="gas">Plyn</label>
                                <input type="checkbox" name="gas"><br>
        
                                <label for="elevator">Výtah(počet)</label>
                                <input type="number" name="elevator"><br>
        
                                <input type="submit" value="Registrovat" class="btn btn-primary">
                                </form>
                            </div>
                        </div>

                    @foreach ($allbuildings as $building)
                    <div class="card">
                            <form action="su/edit/building/{{$building->id}}" method="post">
                                @csrf
                        <div class="card-header"><label for="city">Město:</label><input type="text" name="city" value="{{$building->city}}"><label for="street">Ulice:</label><input type="text" name="street" value="{{$building->street}}"><label for="">ID: {{$building->id}}</label></div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            <div class="row justify-content-around"><label for="house_number">Číslo popisné:</label><input type="number" name="house_number" value="{{$building->house_number}}"><br></div>
                            <div class="row justify-content-around"><label for="postal">Poštovní směrovací číslo:</label><input type="number" name="postal" value="{{$building->postal}}"><br></div>
                            @if ($building->owner_id === null)
                            <div class="row justify-content-around"><label for="owner_id">ID Vlastníka:</label>
                            <select name="owner_id" value="{{$building->owner_id}}">
                                <option value="">Nemám vlastníka</option>
                                @foreach ($allowners as $owner)
                                    @foreach ($users as $user)
                                        @if ($owner->user_id === $user->id)
                                            <option value="{{$owner->id}}">{{$owner->id}} {{$user->first_name}} {{$user->last_name}}</option> 
                                        @endif
                                    @endforeach
                                @endforeach
                            </select><br>    
                            </div>    
                            @else
                            <div class="row justify-content-around"><label for="owner_id">ID Vlastníka:</label><input type="number" name="owner_id" value="{{$building->owner_id}}" placeholder="nemám vlastníka"><br></div>    
                            @endif
                            
                            
                            
                            <div class="row justify-content-around"><label for="floors_above_ground">Pater nad zemí:</label><input type="number" name="floors_above_ground" value="{{$building->floors_above_ground}}"><br></div>
                            <div class="row justify-content-around"><label for="floors_bellow_ground">Pater pod zemí:</label><input type="number" name="floors_bellow_ground" value="{{$building->floors_bellow_ground}}"><br></div>
                            <label for="heating">Vytápění:</label>
                            <select name="heating" value="{{$building->heating}}">
                                    <option value="1">Ano</option>
                                    <option value="0">Ne</option>
                            </select><br>
                            <label for="gas">Plyn:</label>
                            <select name="gas" value="{{$building->gas}}">
                                    <option value="1">Ano</option>
                                    <option value="0">Ne</option>
                            </select><br>
                            <div class="row justify-content-around"><label for="elevator">Výtahů:</label><input type="number" name="elevator" value="{{$building->elevator}}"><br></div>

                            <div class="row justify-content-around">

                            <div class="row justify-content-left"><input type="submit" value="Uložit změny" class="btn btn-primary"></div>
                            <div class="row justify-content-right"><a href="/home/building/{{$building->id}}" class="btn btn-primary">Budova</a></div>
                        </form>
                        <form action="su/delete/building/{{$building->id}}" method="post"> {{-- tlačítko na smazání --}}
                            @csrf
                            <input type="submit" value="Smazat" class="btn btn-danger">
                        </form>

                    </div>
                        </div>
                    </div>
                    @endforeach
                
                </div>
            </div>
            @endif

            @if ($profil == 'superuser')
            <div class="card">
                <div class="card-header"><p id="owners">Vlastníci</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header"><p>Registrace Vlastníka</p></div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="/owner" method="post" enctype="multipart/form-data">   {{-- Formulář pro registraci budovy       Zpracovává BuildingController@store --}}
                            @csrf

                            <select name="user_id">
                                <option value="0">Výběr Uživatele</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->id}} {{$user->first_name}} {{$user->last_name}}</option>
                                @endforeach
                            </select><br>

                            <select name="building_id">
                                    <option value="0">Výběr Budovy</option>
                                    @foreach ($allbuildings as $building)
                                        <option value="{{$building->id}}">{{$building->id}} {{$building->city}} {{$building->street}} {{$building->house_number}}</option>
                                    @endforeach
                                </select><br>

                            <input type="submit" value="Registrovat" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    @foreach ($allowners as $owner)
                    @foreach ($users as $user)
                    @if ($owner->user_id === $user->id) 
                    <div class="card">
                        <form action="su/edit/owner/{{$owner->id}}" method="post">
                            @csrf
                        <div class="card-header"><label for="">ID: {{$owner->id}} {{$user->first_name}} {{$user->last_name}}</label></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="row justify-content-around"><label for="user_id">ID Uživatele:</label><input type="number" name="user_id" value="{{$owner->user_id}}"><br></div>
                        <div class="row justify-content-around"><label for="building_id">ID Budovy:</label><input type="number" name="building_id" value="{{$owner->building_id}}"><br></div>

                        <div class="row justify-content-around">

                                <div class="row justify-content-left"><input type="submit" value="Uložit změny" class="btn btn-primary"></div>
                    </form>
                    <form action="su/delete/owner/{{$owner->id}}" method="post">        {{-- tlačítko na smazání --}}
                        @csrf
                        <input type="submit" value="Smazat" class="btn btn-danger">
                    </form>
                </div>
                    </div>
                </div>
                    @endif
                    @endforeach
                    @endforeach
                
                </div>
            </div>
            @endif

            @if ($profil == 'superuser')
            <div class="card">
                <div class="card-header"><p id="admins">Správci</p></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header"><p>Registrace Správce</p></div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="/admin" method="post" enctype="multipart/form-data">
                            @csrf

                            <select name="user_id">
                                <option value="0">Výběr Uživatele</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->id}} {{$user->first_name}} {{$user->last_name}}</option>
                                @endforeach
                            </select><br>

                            <select name="building_id">
                                    <option value="0">Výběr Budovy</option>
                                    @foreach ($allbuildings as $building)
                                        <option value="{{$building->id}}">{{$building->id}} {{$building->city}} {{$building->street}} {{$building->house_number}}</option>
                                    @endforeach
                                </select><br>

                            <input type="submit" value="Registrovat" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    @foreach ($alladmins as $admin)
                    @foreach ($users as $user)
                    @if ($admin->user_id === $user->id) 
                    <div class="card">
                        <form action="su/edit/admin/{{$admin->id}}" method="post">
                            @csrf
                        <div class="card-header"><label for="{{$admin->id}}">ID: {{$admin->id}} {{$user->first_name}} {{$user->last_name}}</label></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="row justify-content-around"><label for="user_id">ID Uživatele:</label><input type="number" name="user_id" value="{{$admin->user_id}}"><br></div>
                        <div class="row justify-content-around"><label for="building_id">ID Budovy:</label><input type="number" name="building_id" value="{{$admin->building_id}}"><br></div>

                        <div class="row justify-content-around">

                                <div class="row justify-content-left"><input type="submit" value="Uložit změny" class="btn btn-primary"></div>
                    </form>
                    <form action="su/delete/admin/{{$admin->id}}" method="post">
                        @csrf
                        <input type="submit" value="Smazat" class="btn btn-danger">
                    </form>
                </div>
                    </div>
                </div>
                    @endif
                    @endforeach
                    @endforeach
                
                </div>
            </div>
            @endif


            



        </div>
    </div>
    </div>
</div>
@endsection




