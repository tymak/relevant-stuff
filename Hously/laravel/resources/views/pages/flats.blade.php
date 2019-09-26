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
Available flats   
@endsection

@section ('content')

<main class="bg__wall">
<section class="page__main bg__gradient-light">
    
    @foreach ($list_of_flats as $one_flat)
    
    <div class="page__main__dash__item" id="{{$one_flat->id}}">
            <div class="page__main__dash__item__head">
              
            </div>
        <div class="page__main__dash__item__body">
            <div style="display: flex; justify-content: space-around;">
                   


                    @foreach ($allbuildings as $building)
                    @if ($building->id === $one_flat->building_id)
                           
                    <table>
                            
                            <tr><td>Adress</td><td>{{$building->city}}</td><td> {{$building->street}} {{$building->house_number}}</td></tr>
                            <tr><td>floor:</td> <td>{{$one_flat->floor}}</td>
                            <tr><td>type:</td><td>{{$one_flat->residential?"Residential":"Commercial"}}
                            </tr>

                            <tbody>
                            </tbody>

                    </table>
                    @endif
                    @endforeach


      
            </div>            
        </div>
    </div>
    @endforeach
</section>
</main>
@endsection