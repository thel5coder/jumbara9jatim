<template>
    <div>
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>
                        <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{pageTitle}}</span> - {{pageSection}}
                        <div v-show="welcome">
                            <h3 v-if="$auth.user().user_level_id == 1" class="display-block">Selamat datang {{$auth.user().user_name }} !</h3>
                            <h3 v-if="contingent && $auth.user().user_level_id == 2" class="display-block">Selamat Datang Kontingen PMI {{contingent.contingentName}} !</h3>
                        </div>
                    </h4>

                    <ul class="breadcrumb breadcrumb-caret position-right">
                       <li v-for="(breadcrumbItem,index) in breadcrumbItems" :key="index">
                           <router-link :to="{name:breadcrumbItem.url}">{{breadcrumbItem.title}}</router-link>
                       </li>
                        <li class="active">{{activeSection}}</li>
                    </ul>
                </div>

                <div class="heading-elements">
                    <div class="heading-btn-group">
                        <router-link v-if="headingItems" v-for="(headingItem,index) in headingItems" :to="{name:headingItem.url}" :key="index" class="btn btn-link btn-float has-text text-size-small legitRipple"><i
                                :class="[headingItem.icon,'text-indigo-400']"></i><span>{{headingItem.title}}</span></router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        props:{
            welcome:Boolean,
            pageTitle:String,
            pageSection:String,
            breadcrumbItems: Array,
            headingItems:Array,
            activeSection:String
        },
        mounted(){
            if(this.$auth.user().user_level_id == 2){
                this.$store.dispatch('ContingentStore/read',{id:this.$auth.user().contingent_id})
            }
        },
        computed:{
            ...mapGetters('ContingentStore',{contingent:'getContingent'})
        }
    }
</script>

<style scoped>

</style>