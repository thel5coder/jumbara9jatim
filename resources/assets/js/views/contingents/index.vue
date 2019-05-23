<template>
    <div>
        <page-header :page-section="'Data Kontingen'" :page-title="'Kontingen'" :active-section="'Data Kontingen'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="contingents" :data="contingents" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editContingent',params:{id:props.row.id}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple" v-tooltip.top="tooltipMessage.edit">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteContingent(props.row.id,props.row.contingentName)"
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
                headingItems:[{url:'createContingent',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','ID','Kontingen','Aktif','Aksi'],
                columns:['no','contingentId','contingentName','isActive','actions'],
                tooltipMessage:{delete:'Hapus',edit:'Ubah'},
                options: {
                    headings: {
                        no: 'No',
                        contingentId: 'ID',
                        contingentName: 'Kontingen',
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
                    sortable: ['contingentId', 'contingentName'],
                    filterable: ['contingentId', 'contingentName']
                },
                stateName:'ContingentStore'
            }
        },
        mounted(){
            this.$store.dispatch('ContingentStore/browse')
        },
        computed:{
            ...mapGetters('ContingentStore',{contingents:'getContingents'})
        },
        methods:{
            ...mapActions('ContingentStore',{delContingent:'del'}),
            deleteContingent(id,contingentName){
                let index = this.contingents.findIndex(data => data.id === id)

                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data kontingen "+contingentName,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if(result.value){
                        this.delContingent({id:id,index:index})
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>