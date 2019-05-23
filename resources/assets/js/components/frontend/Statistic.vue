<template>
    <div>
        <div class="container-fluid mt-10">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-bold text-center">Statistik</h5>
                </div>
                <div class="panel-body mt-1" v-if="participants">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="panel panel-flat">
                                <div class="row">
                                    <div class="col-md-3 col-xs-3 no-margin bg-green p-10 text-center text-bold">
                                        <span>{{participants.mula}}</span>
                                    </div>
                                    <div class="col-md-8 col-xs-8 text-center text-bold p-10">
                                        <span>PMR Mula</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="panel panel-flat">
                                <div class="row">
                                    <div class="col-md-3 col-xs-3 no-margin bg-blue p-10 text-center text-bold">
                                        <span class="text-center text-bold">{{participants.madya}}</span>
                                    </div>
                                    <div class="col-md-8 col-xs-8 text-center text-bold p-10">
                                        <span>PMR  Madya</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="panel panel-flat">
                                <div class="row">
                                    <div class="col-md-3 col-xs-3 no-margin bg-orange p-10 text-center text-bold">
                                        <span class="text-center text-bold">{{participants.wira}}</span>
                                    </div>
                                    <div class="col-md-8 col-xs-8 text-center text-bold p-10">
                                        <span>PMR  Wira</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="panel panel-flat">
                                <div class="row">
                                    <div class="col-md-3 col-xs-3 no-margin bg-violet p-10 text-center text-bold">
                                        <span class="text-center text-bold">{{participants.contingent}}</span>
                                    </div>
                                    <div class="col-md-8 col-xs-8 text-center text-bold p-10">
                                        <span>Kontingen</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="panel panel-flat">
                                <div class="row">
                                    <div class="col-md-3 col-xs-3 no-margin bg-danger p-10 text-center text-bold">
                                        <span class="text-center text-bold">{{participants.participant}}</span>
                                    </div>
                                    <div class="col-md-8 col-xs-8 text-center text-bold p-10">
                                        <span>Total Peserta</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        mounted(){
            this.$store.dispatch('ParticipantStore/browse',{url:'participant/statistic'});
        },
        computed:{
            ...mapGetters('ParticipantStore',{participants:'getParticipants'})
        }
    }
</script>

<style scoped>

</style>