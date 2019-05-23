<template>
    <div>
        <div class="row">
            <div class="panel panel-flat" style="border:0px solid #ffffff !important;-webkit-box-shadow: none">
                <div class="panel-heading" style="border:0px solid #ffffff !important;margin-bottom: 0px;padding-bottom: 0px;padding-top: 0px">
                    <legend class="text-bold text-left" style="padding-bottom: 1px;border-bottom: 2px solid #ff0000">Informasi</legend>
                    <div class="heading-elements" style="margin-top: -10px;">
                        <router-link class="btn btn-link" :to="{name:'information'}">Selengkapnya</router-link>
                    </div>
                </div>
                <div class="col-md-4" v-for="information in informations">
                    <div class="media">
                        <div class="media-left">
                            <div class="thumb">
                                <router-link :to="{name:'detailInformation',params:{slug:information.slug}}">
                                    <img :src="'http://jumbara9jatim.info/storage/resized/'+information.featuredImage" class="img-responsive img-rounded media-preview" alt="">
                                </router-link>
                            </div>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <router-link :to="{name:'detailInformation',params:{slug:information.slug}}">{{information.title}}</router-link>
                            </h5>
                            <div class="media-annotation mt-5"><i class="icon-calendar2"></i> &nbsp; {{information.createdAt}}</div>
                            <!--<div class="media-annotation mt-5"><i class="icon-eye"></i> Di lihat &nbsp;{{information.viewCounter}}x</div>-->
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="col-md-4">-->
                <!--<div class="media">-->
                    <!--<div class="media-left">-->
                        <!--<a href="#">-->
                            <!--<img src="http://jumbara9jatim.info/vendor/admin-assets/images/placeholders/placeholder.jpg"-->
                                 <!--class="img-circle img-md">-->
                        <!--</a>-->
                    <!--</div>-->
                    <!--<div class="media-body">-->
                        <!--<h5 class="media-heading">-->
                            <!--<a href="#">Information Title</a>-->
                        <!--</h5>-->
                        <!--<div class="media-annotation mt-5"><i class="icon-calendar2"></i> &nbsp; 22-04-2019</div>-->
                        <!--<div class="media-annotation mt-5"><i class="icon-eye"></i> &nbsp;Di baca 10x</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="col-md-4">-->
                <!--<div class="media">-->
                    <!--<div class="media-left">-->
                        <!--<a href="#">-->
                            <!--<img src="http://jumbara9jatim.info/vendor/admin-assets/images/placeholders/placeholder.jpg"-->
                                 <!--class="img-circle img-md">-->
                        <!--</a>-->
                    <!--</div>-->
                    <!--<div class="media-body">-->
                        <!--<h5 class="media-heading">-->
                            <!--<a href="#">Information Title</a>-->
                        <!--</h5>-->
                        <!--<div class="media-annotation mt-5"><i class="icon-calendar2"></i> &nbsp; 22-04-2019</div>-->
                        <!--<div class="media-annotation mt-5"><i class="icon-eye4"></i> &nbsp;Di baca 10x</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        mounted(){
            this.$store.dispatch('InformationStore/browse',{url:'information-home'})
        },
        computed:{
            ...mapGetters('InformationStore',{informations:'getInformations'})
        }
    }
</script>

<style scoped>

</style>