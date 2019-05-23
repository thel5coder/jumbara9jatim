<template>
    <div>
        <form @submit.prevent="auth()">
            <div class="panel panel-body login-form">
                <div class="text-center">
                    <img src="http://jumbara9jatim.info/img/logojumbaralogin.png" style="height: 200px;width: 153px;">
                </div>
                <div class="text-center">
                    <h5 class="content-group">Halaman Login <br>JUMBARA IX PMR TINGKAT PROVINSI
                        <br>PMI PROVINSI JAWA TIMUR <small class="display-block">masukkan username dan kata sandi di bawah ini</small></h5>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input type="text" class="form-control" placeholder="Masukkan username" id="userName" name="userName" v-model="user.userName">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input type="password" class="form-control" placeholder="Kata sandi..." id="password" name="password" v-model="user.password">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn bg-danger btn-block">Masuk <i class="icon-enter2 position-right"></i></button>
                </div>
            </div>
        </form>
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
                user:{userName:'',password:''}
            }
        },
        methods:{
            ...mapActions('BaseStore',{
                changeLoadingState:'changeLoadingState'
            }),
            auth(){
                let app = this;
                this.changeLoadingState({isLoading:true,labelLoading:'Sedang mengecek autentikasi, tunggu...'});
                this.$auth.login({
                    url:'/auth/login',
                    method:'POST',
                    data:{
                        userName:this.user.userName,
                        password:this.user.password
                    },
                    error:function (error) {
                        this.changeLoadingState({isLoading:false,labelLoading:''})
                        error.response.data.message.forEach((message)=>[
                            app.$toasted.error(message)
                        ])
                    },
                    success:function (r) {
                        this.changeLoadingState({isLoading:false,labelLoading:''})
                        // this.$http.defaults.headers.common['Authorization'] = token;
                    },
                    redirect: '/admin',
                    fetchUser: true,
                })
            }
        }
    }
</script>

<style scoped>

</style>