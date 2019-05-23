<template>
    <div>
        <page-header :page-section="'Ubah Data Peserta'" :page-title="'Peserta'" :active-section="'Ubah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="row">
                                        <div v-if="participant" class="col-md-12">
                                            <form class="form-horizontal" @submit.prevent="validateForm()">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <fieldset class="content-group">
                                                            <legend class="text-bold">Form Peserta</legend>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">NO MIS KTA</label>
                                                                <div class="col-md-5">
                                                                    <input type="text" class="form-control" v-model="participant.mis"
                                                                           placeholder="Masukkan nomor KTA sesuai dengan mis.pmi.or.id"
                                                                           v-validate="'required|max:25'"
                                                                           name="mis" ref="mis" v-focus>
                                                                    <label class="validation-error-label">{{ errors.first('mis') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nama Lengkap</label>
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control" v-model="participant.fullName"
                                                                           placeholder="Masukkan nama lengkap peserta" v-validate="'required'"
                                                                           name="fullName">
                                                                    <label class="validation-error-label">{{ errors.first('fullName') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Tempat / Tanggal Lahir</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" v-model="participant.birthPlace"
                                                                           placeholder="Tempat lahir contoh Mojokerto, Surabaya,.." v-validate="'required'"
                                                                           name="birthPlace">
                                                                    <label class="validation-error-label">{{ errors.first('birthPlace') }}</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control pickadate-selectors"
                                                                           placeholder="Masukkan tanggal lahir" name="birthDate" v-validate="'required'"
                                                                           id="birthDate" v-model="participant.birthDate">
                                                                    <label class="validation-error-label">{{ errors.first('birthDate') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Jenis Kelamin</label>
                                                                <div class="col-md-6">
                                                                    <label class="radio-inline">
                                                                        <input type="radio" name="sex" class="styled"
                                                                               v-model="participant.sex" :value="'Laki - laki'" v-validate="'required'">
                                                                        Laki - laki
                                                                    </label>

                                                                    <label class="radio-inline">
                                                                        <input type="radio" name="sex" class="styled"
                                                                               v-model="participant.sex" :value="'Perempuan'" v-validate="'required'">
                                                                        Perempuan
                                                                    </label>
                                                                    <label class="validation-error-label">{{ errors.first('sex') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Agama</label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control" v-model="participant.religion" name="religion" v-validate="'required'">
                                                                        <option value="">Pilih Agama</option>
                                                                        <option value="Islam">Islam</option>
                                                                        <option value="Kristen">Kristen</option>
                                                                        <option value="Katholik">Katholik</option>
                                                                        <option value="Hindu">Hindu</option>
                                                                        <option value="Budha">Budha</option>

                                                                    </select>
                                                                    <label class="validation-error-label">{{ errors.first('religion') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Alamat Rumah</label>
                                                                <div class="col-md-6">
                                                                            <textarea class="form-control" placeholder="Masukkan alamat rumah atau domisili"
                                                                                      v-model="participant.address" name="address" v-validate="'required'"></textarea>
                                                                    <label class="validation-error-label">{{ errors.first('address') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">No HP aktif</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="phone" placeholder="Masukkan nomor handphone yang aktif"
                                                                           v-model="participant.phone" v-validate="'required'">
                                                                    <label class="validation-error-label">{{ errors.first('phone') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Grup Anggota</label>
                                                                <div class="col-md-5">
                                                                    <select class="form-control" v-model="participant.groupMember" name="groupMember" v-validate="'required'">
                                                                        <option value="">Pilih Grup Anggota</option>
                                                                        <option value="Pengurus PMI">Pengurus PMI</option>
                                                                        <option value="Staf PMI">Staf PMI</option>
                                                                        <option value="Pembina PMR">Pembina PMR</option>
                                                                        <option value="Fasilitator PMR">Fasilitator PMR</option>
                                                                        <option value="PMR">PMR</option>
                                                                        <option value="Sukarelawan">Sukarelawan</option>
                                                                    </select>
                                                                    <label class="validation-error-label">{{ errors.first('groupMember') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Jabatan</label>
                                                                <div class="col-md-5">
                                                                    <select class="form-control" v-model="participant.positionId" name="positionId" v-validate="'required'">
                                                                        <option value="">Pilih Jabatan dalam Jumbara</option>
                                                                        <option v-if="positions" v-for="position in positions" :value="position.id">
                                                                            {{position.positionName}}
                                                                        </option>
                                                                    </select>
                                                                    <label class="validation-error-label">{{ errors.first('positionId') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Email</label>
                                                                <div class="col-md-5">
                                                                    <input type="email" class="form-control" name="email" v-model="participant.email"
                                                                           placeholder="Masukkan alamat email yang aktif">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Aktif ?</label>
                                                                <div class="col-md-5">
                                                                    <div class="checkbox checkbox-switchery">
                                                                        <label>
                                                                            <input type="checkbox" class="switchery" checked="checked"
                                                                                   v-model="participant.isActive">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <fieldset class="content-group">
                                                            <legend class="text-bold">Unggah Foto </legend>
                                                            <vue-dropzone id="dropzone"
                                                                          :headers="headersDrop" :options="dropzonePhoto"
                                                                          v-on:vdropzone-success="dropzonePhotograpSuccess"
                                                                          ref="dropzonePhotograph" v-on:vdropzone-mounted="dropzonePhotographMounted">

                                                            </vue-dropzone>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <fieldset class="content-group">
                                                            <legend class="text-bold">Unggah Asuransi </legend>
                                                            <vue-dropzone id="dropzone" :options="dropzoneInsurance"
                                                                          v-on:vdropzone-success="dropzoneInsuranceSucess"
                                                                          ref="dropzoneInsurance"
                                                                          v-on:vdropzone-mounted="dropzoneAnsuranceMounted">

                                                            </vue-dropzone>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <fieldset class="content-group">
                                                            <legend class="text-bold">Unggah KTA MIS </legend>
                                                            <vue-dropzone id="dropzone" :options="dropzoneKta"
                                                                          v-on:vdropzone-success="dropzoneKtaSuccess"
                                                                          v-on:vdropzone-mounted="dropzoneKtaMounted" ref="dropzoneKta"></vue-dropzone>
                                                        </fieldset>
                                                    </div>
                                                </div>
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
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexParticipant',title:'Peserta'}],
                headingItems:[{url:'indexParticipant',title:'Kembali',icon:'icon-backward2'}],
                dataIndex:null,
                dropzonePhoto: {
                    url: 'http://jumbara9jatim.info/api/participant/upload-document',
                    thumbnailWidth: 150,
                    paramName: "file",
                    maxFilesize: 1,
                    addRemoveLinks:true,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    dictDefaultMessage: 'Klik disini untuk unggah',
                    headers:{
                        'Authorization':'Bearer '+this.$auth.token()
                    },
                    renameFile(file){
                        let fileType = file.type
                        let extension = fileType.toString().split('/')
                        let uniqe = new Date()
                        return 'photograph'+uniqe.getTime()+'.'+extension[1]
                    }
                },
                dropzoneInsurance:{
                    url: 'http://jumbara9jatim.info/api/participant/upload-document',
                    thumbnailWidth: 150,
                    paramName: "file",
                    maxFilesize: 1,
                    addRemoveLinks:true,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    dictDefaultMessage: 'Klik disini untuk unggah',
                    headers:{
                        'Authorization':'Bearer '+this.$auth.token()
                    },
                    renameFile(file){
                        let fileType = file.type
                        let extension = fileType.toString().split('/')
                        let uniqe = new Date()
                        return 'insureance'+uniqe.getTime()+'.'+extension[1]
                    }
                },
                dropzoneKta:{
                    url: 'http://jumbara9jatim.info/api/participant/upload-document',
                    thumbnailWidth: 150,
                    paramName: "file",
                    maxFilesize: 1,
                    addRemoveLinks:true,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    dictDefaultMessage: 'Klik disini untuk unggah',
                    headers:{
                        'Authorization':'Bearer '+this.$auth.token()
                    },
                    renameFile(file){
                        let fileType = file.type
                        let extension = fileType.toString().split('/')
                        let uniqe = new Date()
                        let newFileName = 'kta'+uniqe.getTime()+'.'+extension[1]
                        return newFileName
                    }
                },
                dict:{
                    en:{
                        attributes:{
                            max:'No KTA hanya boleh maksimal 15 karakter'
                        }
                    },
                    custom:{
                        mis:{
                            required:'NO KTA tidak boleh kosong'
                        },
                        fullName:{
                            required:'Nama lengkap tidak boleh kosong'
                        },
                        birthPlace:{
                            required:'Tempat lahir tidak boleh kosong'
                        },
                        birthDate:{
                            required:'Tanggal lahir tidak boleh kosong'
                        },
                        sex:{
                            required:'Pilih salah satu jenis kelamin'
                        },
                        religion:{
                            required:'Pilih salah satu agama'
                        },
                        address:{
                            required:'Alamat tidak boleh kosong'
                        },
                        phone:{
                            required:'Nomor telepon tidak boleh kosong'
                        },
                        groupMember:{
                            required:'Pilih salah satu grup anggota'
                        },
                        positionId:{
                            required:'Pilih salah satu jabatan'
                        }
                    }
                }
            }
        },
        mounted(){
            let app = this

            $('.pickadate-selectors').pickadate({
                selectYears: 219,
                selectMonths: true,
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd',
                monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'December'],
                onClose(){
                    app.participant.birthDate = this.get()
                }
            });
            $(".styled").uniform();

        },
        beforeMount(){
        },
        created(){
            this.$store.dispatch('PositionStore/browse');
            if(this.participants == null){
                this.$store.dispatch('ParticipantStore/read',{id:this.$route.params.id,index:null})
            }else{
                this.dataIndex = this.participants.findIndex(data => data.id === this.$route.params.id)
                this.$store.dispatch('ParticipantStore/read',{id:this.$route.params.id,index:this.dataIndex})
            }
        },
        computed:{
            ...mapGetters('PositionStore',{positions:'getPositions'}),
            ...mapGetters('ParticipantStore',{participants:'getParticipants',participant:'getParticipant'}),
            headersDrop(){
                return {
                    'Authorization':'Bearer '+this.$auth.token()
                }
            }
        },
        methods:{
            ...mapActions('ParticipantStore',{editParticipant:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.participant.contingentId = this.$auth.user().contingent_id;
                        let response = this.editParticipant({input:this.participant,index:this.dataIndex})
                        response.then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexParticipant'})
                        }).catch((error)=>{
                            this.$toasted.error(error)
                        })

                    }else{
                        console.log(errors.all())
                    }
                })
            },
            dropzoneSendEvent(file,xhr,formData){
                formData.append('userDir',this.participant.mis)
            },
            dropzonePhotograpSuccess(file,response){
                this.participant.photograph = response.result
            },
            dropzoneInsuranceSucess(file,response){
                this.participant.ansurance = response.result
            },
            dropzoneKtaSuccess(file,response){
                this.participant.misImage = response.result
            },
            dropzonePhotographMounted(){
                let file = {size:123,name:this.participant.photograph}
                let url = 'http://jumbara9jatim.info/storage/document/resized/'+this.participant.photograph
                this.$refs.dropzonePhotograph.manuallyAddFile(file,url)
            },
            dropzoneAnsuranceMounted(){
                let file = {size:123,name:this.participant.ansurance}
                let url = 'http://jumbara9jatim.info/storage/document/resized/'+this.participant.ansurance
                this.$refs.dropzoneInsurance.manuallyAddFile(file,url)
            },
            dropzoneKtaMounted(){
                let file = {size:123,name:this.participant.misImage}
                let url = 'http://jumbara9jatim.info/storage/document/resized/'+this.participant.misImage
                this.$refs.dropzoneKta.manuallyAddFile(file,url)
            }
        }
    }
</script>

<style scoped>

</style>