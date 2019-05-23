@extends('frontoffice.main')
@section('title'.'Beranda')
@section('content')
        <section class="konten">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="container" style="border: 0px solid #000; text-align: center; margin-bottom: 5px;">
                        <h4 class="login">Login</h4>
                        <form class="login">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" placeholder="Masukkan uername">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="Password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-danger btn-login">login</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('img/slider/1.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('img/slider/2.jpg')}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('img/slider/3.jpg')}}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-2" style="padding-left: 0px;">
                    <div class="container" style="text-align: center">
                        <h5>Statistik</h5>
                        <div class="card card-statistik" style="background-color: #238E52;">
                            <h4>256</h4>
                            <h6>PMR Mula</h6>
                        </div>
                        <div class="card card-statistik" style="background-color: #2C6FC1;">
                            <h4>641</h4>
                            <h6>PMR Madya</h6>
                        </div>
                        <div class="card card-statistik" style="background-color: #F7D002;">
                            <h4>672</h4>
                            <h6>PMR Wira</h6>
                        </div>
                        <div class="card card-statistik" style="background-color: #7A59AF;">
                            <h4>20</h4>
                            <h6>Kontingen</h6>
                        </div>
                        <div class="card card-statistik" style="background-color: #BF1A2F;">
                            <h4>500</h4>
                            <h6>Jumlah Peserta</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row informasi">
                {{--Download--}}
                <div class="col-12 col-md-3 mt-2">
                    <div class="container">
                        <div class="row">
                            <h5>Download</h5><a href="#" style="margin-left: 5px; color: #b21f2d;">selengkapnya</a>
                        </div>
                        <div class="card-download">
                            <h6 class="card-title">Nama File</h6>
                            <a href="#" class="btn btn-sm btn-danger">Download</a>
                            <hr>
                        </div>
                        <div class="card-download">
                            <h6 class="card-title">Nama File</h6>
                            <a href="#" class="btn btn-sm btn-danger">Download</a>
                            <hr>
                        </div>
                    </div>
                </div>
                {{--informasi--}}
                <div class="col-12 col-md-9 mt-2">
                    <div class="container container-info">
                        <div class="row">
                            <h5>Informasi</h5><a href="#" style="margin-left: 5px; color: #b21f2d;">selengkapnya</a>
                        </div>
                        {{--<br>--}}
                        <div class="row">
                            <div class="col-12 col-md-4 col-info">
                                <div class="card card-info">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <img src="{{asset('img/info/1.jpg')}}" class="img-fluid" alt="" width="158">
                                        </div>
                                        <div class="col">
                                            <div class="card-block px-2">
                                                <h6 class="card-title">PMI Distribusikan Bantuan Di Baliase</h6>
                                                <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-info">
                                <div class="card card-info">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <img src="{{asset('img/info/2.jpg')}}" class="img-fluid" alt="" width="158">
                                        </div>
                                        <div class="col">
                                            <div class="card-block px-2">
                                                <h6 class="card-title">200 Juta Didonasikan Bank of China Untuk jayapura</h6>
                                                <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-info">
                                <div class="card card-info">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <img src="{{asset('img/info/3.jpg')}}" class="img-fluid" alt="" width="158">
                                        </div>
                                        <div class="col">
                                            <div class="card-block px-2">
                                                <h6 class="card-title">Kebumen Selenggarakan Olimpiade PMR</h6>
                                                <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--support--}}
            <div class="support">
                <div class="container container-support">
                    <h5 style="text-align: center; padding-top: 10px;">Support</h5>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <img src="{{asset('img/support/liputan6.png')}}" alt="" width="250px">
                        </div>
                        <div class="col-md-3 col-12">
                            <img src="{{asset('img/support/kompas.png')}}" alt="" width="250px">
                        </div>
                        <div class="col-md-3 col-12">
                            <img src="{{asset('img/support/techinasia.png')}}" alt="" width="250px">
                        </div>
                        <div class="col-md-3 col-12">
                            <img src="{{asset('img/support/fortune.png')}}" alt="" width="220px">
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('stylespage')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection