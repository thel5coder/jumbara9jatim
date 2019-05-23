<template>
    <div>
        <page-header :page-section="'Ubah Kontingen'" :page-title="'Kontingen'" :active-section="'Ubah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group" v-if="contingent">
                                            <legend class="text-bold">Form Ubah Kontingen</legend>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">ID Kontingen</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" v-model="contingent.contingentId"
                                                           placeholder="Masukkan id kotingen, contoh 1,2" v-validate="'required'"
                                                           name="contingentId">
                                                    <label class="validation-error-label">{{ errors.first('contingentId') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Kontingen</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="contingent.contingentName"
                                                           placeholder="Masukkan nama kontingen..." v-validate="'required'" name="contingentName">
                                                    <label class="validation-error-label">{{ errors.first('contingentName') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Aktif ?</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switchery">
                                                        <label>
                                                            <input type="checkbox" class="switchery" checked="checked"
                                                                   v-model="contingent.isActive">
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
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexContingent',title:'Kontingen'}],
                headingItems:[{url:'indexContingent',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        contingentId:{
                            required:'Id kontingen tidak boleh kosong'
                        },
                        contingentName:{
                            required:'Nama kontingen tidak boleh kosong'
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

            if(this.contingents != null){
                let index = this.contingents.findIndex(data => data.id === this.$route.params.id)
                this.$store.dispatch('ContingentStore/read',{id:this.$route.params.id,index:index})
            }else{
                this.$store.dispatch('ContingentStore/read',{id:this.$route.params.id,index:null})
            }
        },
        computed:{
            ...mapGetters('ContingentStore',{contingents:'getContingents',contingent:'getContingent'})
        },
        methods:{
            ...mapActions('ContingentStore',{updateContingent:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        let response = this.updateContingent({input:this.contingent})
                        response.then((result)=>{
                            if(result){
                                this.$router.push({name:'indexContingent'})
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