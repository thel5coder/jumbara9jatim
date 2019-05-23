<nav class="navbar fixed-top navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('img/logo.png')}}" alt="" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active" href="{{route('indexHome')}}">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="{{route('Profil')}}">Profil</a>
                <a class="nav-item nav-link" href="{{route('Informasi')}}">Informasi</a>
                <a class="nav-item nav-link" href="#">Download</a>
                <a class="nav-item nav-link" href="{{route('Hubungi')}}">Hubungi Kami</a>
            </div>
        </div>
    </div>
</nav>
@section('stylespage')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection