@extends ('layouts/houslytemplate')

@section ('title') About Hously 
@endsection 

@section ('nav') 
    <li class="nav-item ml-2">
        <a class="nav-link active" href="/about">About Hously</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" href="/flats">Available Appartments</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" href="/houses">Involved Houses</a>
    </li>
@endsection


@section ('content')

<main class="bg__secondary">
    <section class="page__main bg__gradient">
        <div class="page__main__promo">
            <h1>About Hously</h1>
            <h5>Join us on our journey</h5>
        </div>
        <div class="page__main__info bg__gray">
                <div class="div_4"><h2>You shoud know that Hously ...</h2></div>
                <div class="div_1 ">
                    <img src="./img/h-icon.svg" alt=""> 
                </div>
                <div class="div_3">
                    <h3>is the best app for your home.</h3>
                    <p>Do you own a house, flat or are you just renting one? Hously will help you to stay organized and easily manage all needs of your property.</p> 
                </div>
                <div class="div_1">
                    <img src="./img/h-icon.svg" alt=""> 
                </div>
                <div class="div_3">
                    <h3>a tool everyone will love</h3>
                    <p>Hously is for residents as well as for flat owners or facility managers.</p> 
                </div>
                <div class="div_1">
                    <img src="./img/h-icon.svg" alt=""> 
                </div>
                <div class="div_3">
                    <h3>brings neighbours closer together and keeps residents informed</h3>
                    <p>With Hously you can let residents of your house organize community gatherings and share them with each other as well as keep your residents informed about important upcoming events. </p> 
                </div>

        </div>
        <div class="page__main__timeline bg__gray">
                <h2>Our history</h2>
            <div class="page__main__timeline__bubble b__right">
                <h3>We started as student project</h3>
                <p>We started in summer 2019 during a coding Bootcamp. In team of four we prepared the minimal project which we then presented to investors</p>
            </div>
            <div class="page__main__timeline__bubble b__left">
                <h3>Our first customer was a small company from Moravia</h3>
                <p>Velkaneznama s.r.o, a company from Vsetin, implemented Hously to manage a flat house they owned. Residents were satisfied with the app and the word soon began to spread about Hously...</p>
            </div>
            <div class="page__main__timeline__bubble b__right">
                <h3>We expanded quickly</h3>
                <p>During the first year of existence, Hously helped over 50 clients with managing their houses</p>
            </div>
        </div>
    </section>
    
</main>

@endsection