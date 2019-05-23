<template>
    <div>
        <nav class="navbar navbar-default navbar-component navbar-fixed-top mb-0">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><img src="http://jumbara9jatim.info/img/logo2.png" alt="" style="height: 60px;width: 120px; margin-top: -20px;"></a>


                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-demo-mobile"><i class="icon-grid3"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-demo-mobile">

                <ul class="nav navbar-nav navbar-right">
                    <li><router-link :to="{name:'home'}">Home</router-link></li>
                    <li><router-link :to="{name:'profile'}">Profil</router-link></li>
                    <li><router-link :to="{name:'information'}">Informasi</router-link></li>
                    <li><router-link :to="{name:'download'}">Download</router-link></li>
                    <li><router-link :to="{name:'contact'}">Hubungi Kami</router-link></li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
    }
</script>

<style scoped>
    @import 'http://jumbara9jatim.info/css/style.css';
    /*.router-link-active{*/
        /*background-color: #0a001f;*/
        /*color:#ffffff;*/
    /*}*/
    /*.router-link-exact-active{*/
        /*background-color: #FF0000;*/
        /*color: #ffffff;*/
    /*}*/
    .active{
        border-bottom: 2px solid #FF0000;
    }
</style>