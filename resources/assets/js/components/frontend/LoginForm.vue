<template>
    <div>
        <div class="container-fluid mt-10">
            <div class="panel panel-flat" style="height: 341px;">
                <div class="panel-heading pb-10 pt-5">
                    <h5 class="panel-title text-center text-bold"> Login Jumbara</h5>
                </div>
                <div class="panel-body" style="margin-top: -5px">
                    <div class="text-center">
                        <img src="http://jumbara9jatim.info/img/logojumbaralogin.png"
                             style="height: 120px;width: 100px;">
                    </div>
                    <form @submit.prevent="validateForm">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="icon-user-lock"></i>
                                </span>
                                <input type="text" class="form-control no-margin-top" id="userName" name="userName"
                                       v-model="userName"
                                       placeholder="Masukkan username" v-validate="'required'">
                                <label class="validation-error-label">{{ errors.first('userName') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="icon-lock2"></i>
                                </span>
                                <input type="password" class="form-control no-margin-top" id="password" name="password"
                                       v-model="password"
                                       placeholder="Masukkan kata sandi" v-validate="'required'">
                                <label class="validation-error-label">{{ errors.first('password') }}</label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger legitRipple text-center">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {
        data() {
            return {
                userName: '',
                password: '',
                dict: {
                    custom: {
                        userName: {
                            required: 'User name tidak boleh kosong'
                        },
                        password: {
                            required: 'Kata sandi tidak boleh kosong'
                        }
                    }
                }
            }
        },
        methods: {
            ...mapActions('BaseStore', {
                changeLoadingState: 'changeLoadingState'
            }),
            validateForm() {
                let app = this
                let validator = this.$validator
                validator.localize('en', this.dict)

                validator.validateAll().then((result) => {
                    if (result) {
                        this.changeLoadingState({
                            isLoading: true,
                            loadingMessage: 'Sedang mengecek autentikasi, tunggu...'
                        });
                        this.$auth.login({
                            url: '/auth/login',
                            method: 'POST',
                            data: {
                                userName: this.userName,
                                password: this.password
                            },
                            error: function (error) {
                                this.changeLoadingState({isLoading: false, labelLoading: ''})
                                error.response.data.message.forEach((message) => [
                                    app.$toasted.error(message)
                                ])
                            },
                            success: function (r) {
                                this.changeLoadingState({isLoading: false, labelLoading: ''})
                                // this.$http.defaults.headers.common['Authorization'] = token;
                            },
                            redirect: '/admin',
                            fetchUser: true,
                        });
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>