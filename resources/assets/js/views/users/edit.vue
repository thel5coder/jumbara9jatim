<template>
    <div>
        <page-header :page-section="'Tambah Pengguna'" :page-title="'Pengguna'" :active-section="'Tambah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12" v-if="user">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Form Tambah Pengguna</legend>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">User Name</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="user.userName"
                                                           placeholder="Masukkan user name" v-validate="'required'"
                                                           name="userName">
                                                    <label class="validation-error-label">{{ errors.first('userName') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Level Pengguna</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" name="userLevelId" v-validate="'required'" v-model="user.userLevelId">
                                                        <option value="">Pilih Level Pengguna</option>
                                                        <option v-for="userLevel in userLevels" :value="userLevel.id">{{userLevel.levelName}}</option>
                                                    </select>
                                                    <label class="validation-error-label">{{ errors.first('userLevelId') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group" v-if="user.userLevelId == 2">
                                                <label class="control-label col-md-3">Level Pengguna</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" name="contingentId" v-model="user.contingentId">
                                                        <option value="">Pilih Kontingen</option>
                                                        <option v-for="contingent in contingents" :value="contingent.id">{{contingent.contingentName}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Aktif ?</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switchery">
                                                        <label>
                                                            <input type="checkbox" class="switchery" checked="checked" v-model="user.isActive">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary btn-icon">
                                                <i class="icon-floppy-disk position-left"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
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
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexUser',title:'Data Pengguna'}],
                headingItems:[{url:'indexUser',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        userName:{
                            required:'Level pengguna tidak boleh kosong'
                        },
                        password:{
                            required:'Kata sandi tidak boleh kosong',
                            min:'Kata sandi minimal 6 karakter'
                        },
                        userLevelId:{
                            required:'Pilih salah satu level pengguna'
                        },
                    }
                }
            }
        },
        mounted(){
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html);
            });
            this.$store.dispatch('UserLevelStore/browse')
            this.$store.dispatch('ContingentStore/browse')

            if(this.users == null){
                this.$store.dispatch('UserStore/read',{id:this.$route.params.id,index:null})
            }else{
                this.dataIndex = this.users.findIndex(data => data.id === this.$route.params.id)
                this.$store.dispatch('UserStore/read',{id:this.$route.params.id,index:this.dataIndex})
            }
        },
        computed:{
            ...mapGetters('UserLevelStore',{userLevels:'getUserLevels'}),
            ...mapGetters('ContingentStore',{contingents:'getContingents'}),
            ...mapGetters('UserStore',{users:'getUsers',user:'getUser'})
        },
        methods:{
            ...mapActions('UserStore',{editUser:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.editUser({input:this.user}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexUser'})
                        }).catch((error)=>{
                            if(error.response.data){
                                error.response.data.errorMessage.forEach((message)=>{
                                    this.$toasted.error(message)
                                })
                            }
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>