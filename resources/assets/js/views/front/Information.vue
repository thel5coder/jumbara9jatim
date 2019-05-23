<template>
    <section style="margin-top: 50px; background-color: white;">
        <div>
            <div class="row">
                <div class="col-md-3" style="background-color: #ecf5e9;">
                    <login-form></login-form>
                    <statistic></statistic>
                </div>
                <div class="col-md-9" style="background-color: white;margin-top: 20px;">
                    <legend class="text-bold text-left" style="padding-bottom: 1px;border-bottom: 2px solid #ff0000;">Informasi</legend>
                    <div class="row" v-if="informations">
                        <div class="col-md-3" v-for="information in informations">
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
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Login from '../../components/frontend/LoginForm'
    import Statistic from '../../components/frontend/Statistic'
    import {mapGetters} from 'vuex'
    export default {
        components:{
            'login-form':Login,
            'statistic':Statistic
        },
        mounted(){
            this.$store.dispatch('InformationStore/browse',{url:'information-home'})
        },
        computed:{
            ...mapGetters('InformationStore',{informations:'getInformations'})
        }
    }
</script>

<style scoped>
    @import 'http://jumbara9jatim.info/css/information.css';
</style>