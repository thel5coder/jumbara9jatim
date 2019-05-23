<template>
    <div>
        <page-header :page-section="'Data Level Pengguna'" :page-title="'Level Pengguna'" :active-section="'Level Pengguna'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="userLevels" :data="userLevels" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editUserLevel',params:{id:props.row.id}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteUserLevel(props.row.id,props.row.levelName)">
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
    import {mapActions,mapGetters} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'}],
                headingItems:[{url:'createUserLevel',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','Level Pengguna','Aktif','Aksi'],
                columns:['no','levelName','isActive','actions'],
                options: {
                    headings: {
                        no: 'No',
                        levelName: 'Level Pengguna',
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
                    sortable: ['levelName'],
                    filterable: ['levelName']
                },
                stateName:'UserLevelStore'
            }
        },
        mounted(){
            this.$store.dispatch('UserLevelStore/browse')
        },
        computed:{
            ...mapGetters('UserLevelStore',{userLevels:'getUserLevels'})
        },
        methods:{
            ...mapActions('UserLevelStore',{del:'del'}),
            deleteUserLevel(id,levelName){
                let index = this.userLevels.findIndex(data => data.id === id)

                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data level pengguna "+levelName,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if(result.value){
                        this.del({id:id,index:index}).then((result)=>{
                            this.$toasted.success(result)
                        }).catch((error)=>{
                            error.response.data.errorMessage.forEach((message)=>{
                                this.$toasted.error(message)
                            })
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>