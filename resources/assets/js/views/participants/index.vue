<template>
    <div>
        <page-header :page-section="'Data Peserta'" :page-title="'Peserta'" :active-section="'Data Peserta'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="participants" :data="participants" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <button type="button" class="btn btn-icon btn-info legitRipple">
                                                <i class="icon-printer2"></i>
                                            </button>
                                            <router-link :to="{name:'editParticipant',params:{id:props.row.id}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple" v-tooltip.top="tooltipMessage.edit">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteParticipant(props.row.id,props.row.fullName)"
                                                    data-popup="tooltip" title="Hapus" data-placement="top" id="top">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </div>
                                    </v-client-table>
                                </div>
                            </div>
                        </div>
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

    import {mapGetters,mapActions} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'}],
                headingItems:[{url:'createParticipant',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','ID','Nama','Jabatan','PMI Kab/Kota','Aksi'],
                columns:['no','participantId','fullName','contingentName','positionName','actions'],
                tooltipMessage:{delete:'Hapus',edit:'Ubah'},
                options: {
                    headings: {
                        no: 'No',
                        participantId: 'ID Tanda Pengenal',
                        fullName: 'Nama Lengkap',
                        contingentName:'PMI Kab/Kota',
                        positionName:'Jabatan',
                        actions:'Aksi'
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        },
                        participantId:function(h,row,index){
                          return row.participantId+''+row.participantNumber
                        },
                        isActive:function (h,row,index) {
                            if(row.isActive == 1){
                                return 'Ya'
                            }else{
                                return 'Tidak'
                            }
                        },
                        contingentName:function (h,row,index) {
                            return row.contingentName
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['participantId', 'fullName','positionName'],
                    filterable: ['participantId', 'fullName','positionName']
                },
                stateName:'ParticipantStore'
            }
        },
        mounted(){
            var url ='';
            if(this.$auth.user().user_level_id == 1){
                url = 'participant/all'
            }else{
                url = 'participant-contingent/'+this.$auth.user().contingent_id
            }
            this.$store.dispatch('ParticipantStore/browse',{url:url})
        },
        computed:{
            ...mapGetters('ParticipantStore',{participants:'getParticipants'})
        },
        methods:{
            ...mapActions('ParticipantStore',{deleteData:'del'}),
            deleteParticipant(id,participantName){
                let index = this.participants.findIndex(data => data.id === this.$route.params.id)

                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data peserta dengan nama "+participantName,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if(result.value){
                        let response = this.deleteData({id:id,index:index})
                        response.then((result)=>{
                            this.$toasted.success(result)
                        }).catch((result)=>{
                            this.$toasted.error(result)
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>