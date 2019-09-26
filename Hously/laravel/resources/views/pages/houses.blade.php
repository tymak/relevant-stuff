@extends ('layouts/houslytemplate')

@section ('nav') 
    <li class="nav-item ml-2">
        <a class="nav-link " href="/about">About Hously</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" href="/flats">Available Appartments</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link active" href="/houses">Involved Houses</a>
    </li>
@endsection



@section('title')
Our Houses    
@endsection

@section ('content')
<script src="https://api.mapy.cz/loader.js"></script>
<main class="bg__wall">
<section class="page__main bg__gradient-light">
    <div class="page__main__dash">
        <div id = "map" class="page__main__dash__item" style="margin-top: 20vh; min-width:100%">
           
        </div>
    </div>

    @foreach ($allbuildings as $building)
    
    <div class="page__main__dash__item" id="{{$building->id}}">
            <div class="page__main__dash__item__head">
                <h3>{{$building->city}} {{$building->street}} {{$building->house_number}}</h3>
            </div>
        <div class="page__main__dash__item__body">
            <div style="display: flex; justify-content: space-around;">

                    <img src="http://www.ziprealty.cz/uploads/2016/08/01-villa-apus-byty-krakovska-developerske-projekty-nove-mesto-praha-1-1470737183.jpg" alt="" srcset="" style="max-width: 45%; max-height: 45%; align-self: left">
                    
                    <table>
                
                            <thead></thead>
                            
                            <tbody>
                                <tr><td>Floors:</td><td>Above ground: {{$building->floors_above_ground}}</td></tr>
                                <tr><td></td><td>below ground:{{$building->floors_bellow_ground}}</td></tr>
                                <tr><td>Elevators:</td><td>{{$building->elevator}}</td></tr>
                                <tr><td>Flats:</td><td>
                                    <?php $i = 0; ?>
                                        @foreach ($allflats as $flat)
                                        @if ($flat->building_id === $building->id)
                                        <?php $i++ ?>
                                        @endif
                                        @endforeach
                                            {{$i}}</td></tr>
                                 
                                            <?php $arflats = 0; $acflats = 0 ?>
                                            @foreach ($allflats as $flat)
                                                @if ($flat->building_id === $building->id)
                                                @if ($flat->residential == 1)
                                                <?php $arflats++ ?>
                                            @elseif ($flat->residential == 0)
                                                <?php $acflats++ ?>
                                            @endif
                                                    @foreach ($taken_flats as $taken)
                                                        @if ($flat->id === $taken)
                                                            @if ($flat->residential == 1)
                                                                <?php $arflats-- ?>
                                                            @elseif ($flat->residential == 0)
                                                                <?php $acflats-- ?>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                <tr><td>Avaible flats:</td>
                                <td>Residential:{{$arflats}}</td></tr>
                                <tr><td></td><td>Commercial:{{$acflats}}</td></tr>
                                @if ($building->owner_id === null)
                                    <tr><td>Owner:</td><td>no owner</td></tr>             
                                @else
                                @foreach ($allowners as $owner)
                                @if($building->owner_id === $owner->id)
                                @foreach ($allusers as $user)
                                @if ($owner->user_id === $user->id)
                                    <tr><td>Owner:</td><td>{{$user->first_name}} {{$user->last_name}}</td></tr>             
                                @endif
                                @endforeach
                                @endif
                                @endforeach
                                @endif
                            </tbody>
                        </table>
      
            </div>            
        </div>
    </div>
    @endforeach
</section>
<script src="/js/mapa.js"></script> 
</main>
@endsection