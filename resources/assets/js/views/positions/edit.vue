<template>
    <div>
        <page-header :page-section="'Ubah Jabatan'" :page-title="'Jabatan'" :active-section="'Ubah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group" v-if="position">
                                            <legend class="text-bold">Form Ubah Jabatan</legend>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">ID Jabatan</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" v-model="position.positionId"
                                                           placeholder="Masukkan id jabatan, contoh 1,2" v-validate="'required'"
                                                           name="positionId">
                                                    <label class="validation-error-label">{{ errors.first('positionId') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Jabatan</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="position.positionName"
                                                           placeholder="Masukkan jabatan..." v-validate="'required'" name="positionName">
                                                    <label class="validation-error-label">{{ errors.first('positionName') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Aktif ?</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switchery">
                                                        <label>
                                                            <input type="checkbox" class="switchery" checked="checked"
                                                                   v-model="position.isActive">
                                                        </label>
                                                    </div>
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
    import {mapActions,mapGetters} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexPosition',title:'Jabatan'}],
                headingItems:[{url:'indexPosition',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        positionId:{
                            required:'Id Jabatan tidak boleh kosong'
                        },
                        positionName:{
                            required:'Nama jabatan tidak boleh kosong'
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

            if(this.positions != null){
                let index = this.positions.findIndex(data => data.id === this.$route.params.id)
                this.$store.dispatch('PositionStore/read',{id:this.$route.params.id,index:index})
            }else{
                this.$store.dispatch('PositionStore/read',{id:this.$route.params.id,index:null})
            }
        },
        computed:{
            ...mapGetters('PositionStore',{positions:'getPositions',position:'getPosition'})
        },
        methods:{
            ...mapActions('PositionStore',{updatePosition:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        let response = this.updatePosition({input:this.position})
                        response.then((result)=>{
                            if(result){
                                this.$router.push({name:'indexPosition'})
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