<template>
    <div>
        <page-header :page-section="'Data Pengguna'" :page-title="'Pengguna'" :active-section="'Pengguna'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="users" :data="users" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editUser',params:{id:props.row.id}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteUser(props.row.id,props.row.userName)">
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
    import {mapActions,mapGetters} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'}],
                headingItems:[{url:'createUser',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','User Name','Level','Kontingen','Aktif','Aksi'],
                columns:['no','userName','userLevel','contingent','isActive','actions'],
                options: {
                    headings: {
                        no: 'No',
                        userName: 'User Name',
                        userLevel: 'Level Pengguna',
                        contingent:'Kontingen',
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
                        },
                        contingent:function (h,row,index) {
                            if(row.userLevelId == 2){
                                return 'PMI '+ row.contingent
                            }
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['userName','userLevel'],
                    filterable: ['userName','userLevel']
                },
                stateName:'UserStore'
            }
        },
        mounted(){
            this.$store.dispatch('UserStore/browse')
        },
        computed:{
            ...mapGetters('UserStore',{users:'getUsers'})
        },
        methods:{
            ...mapActions('UserStore',{del:'del'}),
            deleteUser(id,userName){
                let index = this.users.findIndex(data => data.id === id)

                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data pengguna "+userName,
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