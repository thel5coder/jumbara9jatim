<template>
    <div>
        <page-header :page-section="'Ubah Level Pengguna'" :page-title="'Level Pengguna'" :active-section="'Ubah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12" v-if="userLevel">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Form Tambah Level Pengguna</legend>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Nama Level</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="userLevel.levelName"
                                                           placeholder="Masukkan nama level pengguna seperti admin,juri, dll" v-validate="'required'"
                                                           name="levelName">
                                                    <label class="validation-error-label">{{ errors.first('levelName') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Aktif ?</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switchery">
                                                        <label>
                                                            <input type="checkbox" class="switchery" checked="checked" v-model="userLevel.isActive">
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
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexUserLevel',title:'Level Pengguna'}],
                headingItems:[{url:'indexUserLevel',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        levelName:{
                            required:'Level pengguna tidak boleh kosong'
                        }
                    }
                }
            }
        },
        mounted(){
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html);
            });

            if(this.userLevels == null){
                this.$store.dispatch('UserLevelStore/read',{id:this.$route.params.id,index:null})
            }else{
                this.dataIndex = this.userLevels.findIndex(data => data.id === this.$route.params.id)
                this.$store.dispatch('UserLevelStore/read',{id:this.$route.params.id,index:this.dataIndex})
            }
        },
        computed:{
            ...mapGetters('UserLevelStore',{userLevel:'getUserLevel',userLevels:'getUserLevels'})
        },
        methods:{
            ...mapActions('UserLevelStore',{updateUserLevel:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.updateUserLevel({input:this.userLevel}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexUserLevel'})
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