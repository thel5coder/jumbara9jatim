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
                <div>
                    <h4 class="box-tittle red-500">Profil</h4>
                    <hr class="judul">
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium assumenda consequuntur facere
                    nesciunt non possimus praesentium quo voluptas! Adipisci at consequuntur doloribus maiores numquam
                    quibusdam quo reiciendis totam vero, voluptatum?</p>
            </div>
        </div>
    </section>
@endsection
@section('stylespage')
    <link rel="stylesheet" href="{{asset('css/profil.css')}}">
@endsection