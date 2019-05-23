@extends('frontoffice.main')
@section('title'.'Beranda')
@section('content')
    <section class="konten">
        <div class="row" style="padding-bottom: 20px;">
            <div class="col-3">
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
            <div class="col-9">
                <div class="container">
                    <div>
                        <h4 class="box-tittle red-500">Informasi</h4>
                        <hr class="judul">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/1.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                            <h6 class="card-title"><a href="{{route('Detail')}}" style="color: black;">PMI Distribusikan Bantuan Di Baliase</a></h6>
                                            <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/1.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                            <h6 class="card-title">PMI Distribusikan Bantuan Di Baliase</h6>
                                            <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/1.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                            <h6 class="card-title">PMI Distribusikan Bantuan Di Baliase</h6>
                                            <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/1.jpg')}}" class="img-fluid" alt="">
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
                        <div class="col-6">
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/2.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                            <h6 class="card-title">200 Juta Didonasikan Bank of China Untuk jayapura</h6>
                                            <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/2.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                            <h6 class="card-title">200 Juta Didonasikan Bank of China Untuk jayapura</h6>
                                            <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/2.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                            <h6 class="card-title">200 Juta Didonasikan Bank of China Untuk jayapura</h6>
                                            <p class="card-text text-muted">Dilihat 40X<br>Tanggal 6 April</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="row no-gutters">
                                    <div class="col-auto img-info">
                                        <img src="{{asset('img/info/2.jpg')}}" class="img-fluid" alt="">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('stylespage')
    <link rel="stylesheet" href="{{asset('css/informasi.css')}}">
@endsection