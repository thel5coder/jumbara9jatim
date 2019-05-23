<template>
    <div>
        <!-- Main navbar -->
        <div class="navbar navbar-default bg-white">
            <div class="navbar-header">
                <a class="navbar-brand text-danger" href="#">
                    <img src="http://jumbara9jatim.info/img/logojumbaranav.png" alt="" style="width: 120px;height: 60px;margin-top:-20px;">
                </a>

                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">

                <ul class="nav navbar-nav navbar-right">

                    <!--<li class="dropdown">-->
                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                            <!--<i class="icon-bell2"></i>-->
                            <!--<span class="visible-xs-inline-block position-right">Pemberitahuan</span>-->
                            <!--<span class="badge bg-warning-400">2</span>-->
                        <!--</a>-->

                        <!--<div class="dropdown-menu dropdown-content width-350">-->
                            <!--<div class="dropdown-content-heading">-->
                                <!--Pemberitahuan-->
                                <!--<ul class="icons-list">-->
                                    <!--<li><a href="#"><i class="icon-compose"></i></a></li>-->
                                <!--</ul>-->
                            <!--</div>-->

                            <!--<ul class="media-list dropdown-content-body">-->
                                <!--<li class="media">-->
                                    <!--<div class="media-left">-->
                                        <!--<img src="/vendor/admin-assets/images/placeholders/placeholder.jpg" class="img-circle img-sm" alt="">-->
                                        <!--<span class="badge bg-danger-400 media-badge">5</span>-->
                                    <!--</div>-->

                                    <!--<div class="media-body">-->
                                        <!--<a href="#" class="media-heading">-->
                                            <!--<span class="text-semibold">James Alexander</span>-->
                                            <!--<span class="media-annotation pull-right">04:58</span>-->
                                        <!--</a>-->

                                        <!--<span class="text-muted">who knows, maybe that would be the best thing for me...</span>-->
                                    <!--</div>-->
                                <!--</li>-->

                                <!--<li class="media">-->
                                    <!--<div class="media-left">-->
                                        <!--<img src="/vendor/admin-assets/images/placeholders/placeholder.jpg" class="img-circle img-sm" alt="">-->
                                        <!--<span class="badge bg-danger-400 media-badge">4</span>-->
                                    <!--</div>-->

                                    <!--<div class="media-body">-->
                                        <!--<a href="#" class="media-heading">-->
                                            <!--<span class="text-semibold">Margo Baker</span>-->
                                            <!--<span class="media-annotation pull-right">12:16</span>-->
                                        <!--</a>-->

                                        <!--<span class="text-muted">That was something he was unable to do because...</span>-->
                                    <!--</div>-->
                                <!--</li>-->

                                <!--<li class="media">-->
                                    <!--<div class="media-left"><img src="/vendor/admin-assets/images/placeholders/placeholder.jpg" class="img-circle img-sm" alt=""></div>-->
                                    <!--<div class="media-body">-->
                                        <!--<a href="#" class="media-heading">-->
                                            <!--<span class="text-semibold">Jeremy Victorino</span>-->
                                            <!--<span class="media-annotation pull-right">22:48</span>-->
                                        <!--</a>-->

                                        <!--<span class="text-muted">But that would be extremely strained and suspicious...</span>-->
                                    <!--</div>-->
                                <!--</li>-->

                                <!--<li class="media">-->
                                    <!--<div class="media-left"><img src="/vendor/admin-assets/images/placeholders/placeholder.jpg" class="img-circle img-sm" alt=""></div>-->
                                    <!--<div class="media-body">-->
                                        <!--<a href="#" class="media-heading">-->
                                            <!--<span class="text-semibold">Beatrix Diaz</span>-->
                                            <!--<span class="media-annotation pull-right">Tue</span>-->
                                        <!--</a>-->

                                        <!--<span class="text-muted">What a strenuous career it is that I've chosen...</span>-->
                                    <!--</div>-->
                                <!--</li>-->

                                <!--<li class="media">-->
                                    <!--<div class="media-left"><img src="/vendor/admin-assets/images/placeholders/placeholder.jpg" class="img-circle img-sm" alt=""></div>-->
                                    <!--<div class="media-body">-->
                                        <!--<a href="#" class="media-heading">-->
                                            <!--<span class="text-semibold">Richard Vango</span>-->
                                            <!--<span class="media-annotation pull-right">Mon</span>-->
                                        <!--</a>-->

                                        <!--<span class="text-muted">Other travelling salesmen live a life of luxury...</span>-->
                                    <!--</div>-->
                                <!--</li>-->
                            <!--</ul>-->

                            <!--<div class="dropdown-content-footer">-->
                                <!--<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</li>-->

                    <li class="dropdown dropdown-user" v-if="$auth.user().user_level_id == 2">
                        <a>
                            <img src="http://jumbara9jatim.info/img/user.png" alt="">
                            <span v-if="contingent">
                                Kontingen PMI {{contingent.contingentName}}
                            </span>
                        </a>

                        <!--<ul class="dropdown-menu dropdown-menu-right">-->
                            <!--<li><a href="#"><i class="icon-user-plus"></i> Profil</a></li>-->
                            <!--<li><a href="#"><i class="icon-cog5"></i> Ubah Kata Sandi</a></li>-->
                            <!--<li class="divider"></li>-->
                            <!--<li><a href="#"><i class="icon-switch2"></i> Keluar</a></li>-->
                        <!--</ul>-->
                    </li>
                    <li class="dropdown dropdown-user" v-else>
                        <a>
                            <img src="http://jumbara9jatim.info/img/user.png" alt="">
                            <span>
                                {{$auth.user().user_name}}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navbar -->


        <!-- Second navbar -->
        <div class="navbar navbar-default" id="navbar-second">
            <ul class="nav navbar-nav no-border visible-xs-block">
                <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle">
                    <i class="icon-menu7"></i></a></li>
            </ul>

            <div class="navbar-collapse collapse" id="navbar-second-toggle">
                <ul v-if="$auth.user().user_level_id == 1" class="nav navbar-nav navbar-nav-material">
                    <li class="text-white"><router-link :to="{name:'dashboard'}"><i class="icon-home position-left"></i> Dashboard</router-link></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-folder-open2 position-left"></i> Master Data <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu width-200">
                            <li>
                                <router-link :to="{name:'indexUser'}"><i class="icon-user-tie position-left"></i> Pengguna</router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'indexUserLevel'}"><i class="icon-user-lock position-left"></i> Level Pengguna</router-link>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <router-link :to="{name:'indexContingent'}"><i class="icon-make-group position-left"></i> Kontingen</router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'indexPosition'}"><i class="icon-tree7 position-left"></i> Jabatan</router-link>
                            </li>
                            <li><router-link :to="{name:'indexParticipant'}"><i class="icon-user-check position-left"></i> Data Peserta</router-link></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-folder-check position-left"></i>Administrasi Lomba<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu width-200">
                            <li><router-link :to="{name:'indexTaskCategory'}"><i class="icon-list2 position-left"></i> Bidang</router-link></li>
                            <li><router-link :to="{name:'indexTask'}"><i class="icon-task position-left"></i> Bidang Kegiatan</router-link></li>
                            <li><router-link :to="{name:'indexSchedule'}"><i class="icon-calendar2 position-left"></i>Jadwal</router-link></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-anchor position-left"></i>Web Administration <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu width-200">
                            <li><router-link :to="{name:'indexInformation'}"><i class="icon-archive position-left"></i> Informasi</router-link></li>
                            <li><router-link :to="{name:'indexDownload'}"><i class="icon-download7 position-left"></i> Download</router-link></li>
                            <li><router-link :to="{name:'indexSlider'}"><i class="icon-gallery position-left"></i> Slider</router-link></li>
                        </ul>
                    </li>

                    <!--<li class="dropdown">-->
                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                            <!--<i class="icon-gear position-left"></i> Pengaturan <span class="caret"></span>-->
                        <!--</a>-->
                        <!--<ul class="dropdown-menu width-200">-->
                            <!--<li>-->
                                <!--<a href="#">Hak Akes Pengguna</a>-->
                            <!--</li>-->
                        <!--</ul>-->
                    <!--</li>-->

                    <li><a href="#" @click.prevent="$auth.logout()"><i class="icon-exit position-left"></i> Keluar</a></li>
                </ul>
                <ul v-else class="nav navbar-nav navbar-nav-material">
                    <li><router-link :to="{name:'dashboard'}"><i class="icon-home position-left"></i> Dashboard</router-link></li>
                    <li><router-link :to="{name:'indexParticipant'}"><i class="icon-user-check position-left"></i> Data Peserta</router-link></li>
                    <li><router-link :to="{name:'indexAssigment'}"><i class="icon-task position-left"></i> Penugasan</router-link></li>
                    <li><router-link :to="{name:'changePassword'}"><i class="icon-lock2 position-left"></i> Ubah Kata Sandi</router-link></li>
                    <li><a href="#" @click.prevent="$auth.logout()"><i class="icon-exit2 position-left"></i> Keluar</a></li>
                </ul>
            </div>
        </div>
        <!-- /second navbar -->
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        mounted(){
            if(this.$auth.user().user_level_id == 2){
                this.$store.dispatch('ContingentStore/read',{id:this.$auth.user().contingent_id})
            }
        },
        computed:{
            ...mapGetters('ContingentStore',{contingent:'getContingent'})
        }
    }
</script>

<style scoped>
    .active{
        background-color: #FF0000;
        color: #ffffff;
        text-decoration-color: #ffffff;
        border-bottom: solid 2px #000000;
    }

</style>