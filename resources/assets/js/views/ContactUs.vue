<template>
    <div>
        <section  style="margin-top: 50px; background-color: white;">
            <div class="row">
                <div class="col-md-3" style="background-color: #ecf5e9;">
                    <login-form></login-form>
                    <statistic></statistic>
                </div>
                <div class="col-md-9" style="background-color: white; margin-top: 20px;">
                    <legend class="text-bold text-left" style="padding-bottom: 1px;border-bottom: 2px solid #ff0000;">Hubungi Kami</legend>
                    <div class="container">
                        <div class="media">
                            <div class="media-left">
                                <div class="thumb">
                                    <a href="#" >
                                        <img src="http://jumbara9jatim.info/img/contact.png" class="img-responsive img-rounded media-preview" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    Pertanyaan dan informasi lebih lanjut  dapat menghubungi
                                    Panitia Pelaksana Jumbara PMR IX
                                </h5>
                                <div class="media-annotation mt-5 text-bold"><i class="icon-office"></i> PMI Provinsi Jawa Timur </div>
                                <div class="media-annotation mt-5 text-bold"><i class="icon-map4"></i> Jl. Karangmenjangan No. 22 Surabaya</div>
                                <div class="media-annotation mt-5 text-bold"><i class="icon-phone-incoming"></i> Telepon 	: 031 – 5055175</div>
                                <div class="media-annotation mt-5 text-bold"><i class="icon-mail5"></i>Surat Elektronik 	: <a href="mailto:jumbara9pmijatim@gmail.com">jumbara9pmijatim@gmail.com</a> </div>
                                <div class="media-annotation mt-5 text-bold"><i class="icon-mobile2"></i> Narahubung 	: 081357740884</div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="col-md-8">-->
                        <!--<div class="panel panel-flat panel-pesan">-->
                            <!--<div class="panel-heading head-pesan">-->
                                <!--<h5 class="panel-tittle">Kirim Pesan</h5>-->
                            <!--</div>-->
                            <!--<div class="panel-body">-->
                                <!--<div class="form-group">-->
                                    <!--<label>Masukkan Nama:</label>-->
                                    <!--<input type="text" class="form-control" placeholder="Eugene Kopyov">-->
                                <!--</div>-->
                                <!--<div class="form-group">-->
                                    <!--<label>Masukkan Email:</label>-->
                                    <!--<input type="email" class="form-control" placeholder="example@email.com">-->
                                <!--</div>-->
                                <!--<div class="form-group">-->
                                    <!--<label>Masukkan Pesan:</label>-->
                                    <!--<textarea rows="5" cols="5" class="form-control" placeholder="Masukkan Pesan Anda..."></textarea>-->
                                <!--</div>-->
                                <!--<div class="text-right">-->
                                    <!--<button type="submit" class="btn btn-primary legitRipple">Kirim Pesan <i class="icon-envelop5 position-right"></i></button>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import LoginForm from '../components/frontend/LoginForm'
    import Statistic from '../components/frontend/Statistic'
    export default {
        components:{
            'login-form':LoginForm,
            'statistic':Statistic
        }
    }
</script>

<style scoped>
    @import 'http://jumbara9jatim.info/css/hubungi.css';
</style>