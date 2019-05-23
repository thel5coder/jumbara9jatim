<template>
    <div>
        <div class="page-container pb-5">
            <div class="page-content">
                <div class="content-wrapper">
                    <section class="konten">
                        <div class="row">
                            <div class="col-md-3">
                                <login-form></login-form>

                            </div>
                            <div class="col-md-6">
                                <div id="carouselku" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselku" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselku" data-slide-to="1"></li>
                                        <li data-target="#carouselku" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="http://jumbara9jatim.info/img/slider/slider-jumbara-1.jpg" alt="">
                                        </div>

                                        <div class="item">
                                            <img src="http://jumbara9jatim.info/img/slider/slider-jumbara-2.jpg" alt="">
                                        </div>

                                        <div class="item">
                                            <img src="http://jumbara9jatim.info/img/slider/slider-jumbara-3.jpg" alt="">
                                        </div>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#carouselku" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carouselku" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <statistic></statistic>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

        </div>
        <div class="bg-white pb-5">
            <div class="row">
                <div class="container-fluid mb-5">
                    <div class="col-md-12 mb-0">
                        <div class="row">
                            <div class="col-md-3">
                                <download></download>
                            </div>
                            <div class="col-md-9">

                                <information></information>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="support pb-10 mb-10">
            <div class="container container-support">
                <h5 style="text-align: center; padding-top: 10px;">Supported By</h5>
                <div class="row">
                    <div class="col-md-3">
                        <img src="http://jumbara9jatim.info/img/support/fajarmedia.png"  class="img-responsive">
                    </div>
                </div>
            </div>
        </div>

        <loading
                :show="isLoadingShow"
                :label="labelLoading">
        </loading>
    </div>
</template>

<script>
    import LoginForm from '../components/frontend/LoginForm'
    import Slider from '../components/frontend/Sliders'
    import Statistic from '../components/frontend/Statistic'
    import Download from '../components/frontend/Download'
    import Information from '../components/frontend/Information'
    import Support from '../components/frontend/Support'

    export default {
        components:{
            'login-form':LoginForm,
            'image-slider':Slider,
            'statistic':Statistic,
            'download':Download,
            'information':Information,
            'support':Support
        }
    }
</script>

<style scoped>
    @import "http://jumbara9jatim.info/css/style.css";
    @import "http://jumbara9jatim.info/css/home.css";
</style>