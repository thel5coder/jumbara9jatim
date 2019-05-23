<template>
    <section style="margin-top: 50px; background-color: white;">
        <div>
            <div class="row" v-if="information">
                <div class="col-md-3" style="background-color: #ecf5e9;">
                    <login-form></login-form>
                    <statistic></statistic>
                </div>
                <div class="col-md-9" style="background-color: white;margin-top: 20px;">
                    <legend class="text-bold text-left" style="padding-bottom: 1px;border-bottom: 2px solid #ff0000;">{{information.title}}</legend>
                    <div class="row">
                        <div class="col-xs-12">
                            <span v-html="information.content"></span>
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
            let url = 'informasi/'+this.$route.params.slug
            this.$store.dispatch('InformationStore/browse',{url:url})
        },
        computed:{
            ...mapGetters('InformationStore',{information:'getInformations'})
        }
    }
</script>

<style scoped>
    @import 'http://jumbara9jatim.info/css/information.css';
</style>