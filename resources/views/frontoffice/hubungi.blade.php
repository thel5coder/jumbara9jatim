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
                    <h4 class="box-tittle red-500">Hubungi Kami</h4>
                    <hr class="judul">
                </div>
                <div class="container">
                    <h6>Alamat</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus autem, beatae eos maxime
                        nisi nostrum possimus qui. Ab alias, beatae, commodi esse illum labore molestias, obcaecati quia recusandae rem sequi.</p>
                    <h6>Telepon</h6>
                    <p>085678905643</p>
                   <div class="col-6">
                       <form>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Alamat Email</label>
                               <input type="email" class="form-control" id="exampleInputEmail1">
                               <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                           </div>
                           <div class="form-group">
                               <label for="exampleFormControlTextarea1">Masukkan Pesan</label>
                               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                           </div>
                           <button type="submit" class="btn btn-danger">Kirim Pesan</button>
                       </form>
                   </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('stylespage')
    <link rel="stylesheet" href="{{asset('css/hubungi.css')}}">
@endsection