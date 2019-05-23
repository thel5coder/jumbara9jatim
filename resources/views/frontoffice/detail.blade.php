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
                        <h3>PMI Distribusikan Bantuan Di Baliase</h3>
                        <h6 style="font-size: .8rem; color: #696b6a;">6 April 2019</h6>
                        <hr>
                    </div>
                    <div class="img-info">
                        <img src="{{asset('img/info/1.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <p>Palang merah Indonesia (PMI) mendistribusikan sebanyak 731 paket bantuan untuk korban bencana gempa bumi di Desa Baliase kabupaten Donggala.(2/4/19)

                        "Bantuan yang kami distribusikan yakni 2 item yang terdiri dari hegent kit serta ember yang kami satukan menjadi 1 paket untuk setiap kepala keluarga yang berada di di Desa Baliase" kata Moh.Armansyah selaku tim distribusi PMI Sulteng.

                        Menurutnya,dalam pendistribusian tersebut cukup lancar dan berikutnya mereka akan melakukan distribusi kembali karna masih ada beberapa warga yang belum kebagian.

                        Sementara, Sekretaris Desa Baliase Sritajudin (52) mengatakan sangat berterima kasih atas bantuan yang telah diberikan  PMI dalam membantu meringankan beban warga yang tertimpa bencana.

                        "Saya selaku pemerintah Desa mewakili masyarakat berterima kasih kepada PMI atas bantuan yang telah diberikan.kalau bisa kedepannya ada bantuan semisal sembako serta pelayanan kesehatan juga untuk Warga" kata Sritajudin.

                        Ia juga menambahkan bahwa yang menjadi kendala yakni masih ada beberapa warga yang belum mendapatkan  bantuan dikarnakan tidak memiliki kartu kepala keluarga sehingga tidak masuk kedalam data Desa.

                        Sementara salah seorang warga Anissusilawati (47) juga mengatakan bahwa mereka sangat membutuhkan bantuan seperti ini dan berharap akan ada lagi berikutnya seperti bahan pokok dan peralatan masak.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('stylespage')
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection