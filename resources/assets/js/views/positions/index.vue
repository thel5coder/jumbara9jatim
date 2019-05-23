<template>
    <div>
        <page-header :page-section="'Data Jabatan'" :page-title="'Jabatan'" :active-section="'Data Jabatan'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="positions" :data="positions" :name="stateName" :columns="columns" :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editPosition',params:{id:props.row.id}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple" v-tooltip.top="tooltipMessage.edit">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deletePosition(props.row.id,props.row.positionName)"
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
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'}],
                headingItems:[{url:'createPosition',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','ID','Jabatan','Aktif','Aksi'],
                columns:['no','positionId','positionName','isActive','actions'],
                tooltipMessage:{delete:'Hapus',edit:'Ubah'},
                options: {
                    headings: {
                        no: 'No',
                        positionId: 'ID',
                        positionName: 'Jabatan',
                        isActive:'Aktif',
                        actions:'Aksi'
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        },
                        isActive:function (h,row,index) {
                            if(row.isActive == 1){
                                return 'Ya'
                            }else{
                                return 'Tidak'
                            }
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['positionId', 'positionName'],
                    filterable: ['positionId', 'positionName']
                },
                stateName:'PositionStore'
            }
        },
        mounted(){
            this.$store.dispatch('PositionStore/browse')
        },
        computed:{
            ...mapGetters('PositionStore',{positions:'getPositions'})
        },
        methods:{
            ...mapActions('PositionStore',{delPosition:'del'}),
            deletePosition(id,positionName){
                let index = this.positions.indexOf(id)

                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data jabatan "+positionName,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if(result.value){
                        this.delPosition({id:id,index:index})
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>