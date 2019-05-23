<template>
    <div>
        <page-header :page-section="'Ubah Kata Sandi'" :page-title="'User'" :active-section="'Ubah Kata Sandi'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Ubah Kata Sandi</legend>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Username</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" v-model="userName" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Kata Sandi Baru</label>
                                                <div class="col-md-3">
                                                    <input type="password" class="form-control" v-model="password"
                                                           placeholder="Masukkan kata sandi baru" v-validate="'required'"
                                                           name="password" ref="password" v-focus>
                                                    <label class="validation-error-label">{{ errors.first('password') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Konfirmasi Kata Sandi Baru</label>
                                                <div class="col-md-3">
                                                    <input type="password" class="form-control" placeholder="Konfirmasi kata sandi baru" v-model="confirmedPassword"
                                                           v-validate="'required|confirmed:password'" name="confirmedPassword">
                                                    <label class="validation-error-label">{{ errors.first('confirmedPassword') }}</label>
                                                </div>
                                            </div>

                                        </fieldset>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary btn-icon"><i class="icon-floppy-disk position-left"></i> Simpan</button>
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
    import {mapActions} from 'vuex'
    export default {
        data(){
            return {
                password:'',
                confirmedPassword:'',
                userName:this.$auth.user().user_name,
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'}],
                headingItems:[{url:'dashboard',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        password:{
                            required:'Kata sandi baru tidak boleh kosong',
                            min:'Kata sandi minimal memiliki 6 karakter'
                        },
                        confirmedPassword:{
                            confirmed:'Kata sandi tidak sama'
                        }
                    }
                }
            }
        },
        methods:{
            ...mapActions('UserStore',{changePassword:'changePassword'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    let param = {userName:this.$auth.user().user_name,password:this.password}
                    if(result){
                        this.changePassword({input:param}).then((result)=>{
                            this.$toasted.success(result)
                            this.password = ''
                            this.confirmedPassword = ''
                        }).catch((error)=>{
                            error.data.errorMessage.forEach((message)=>{
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