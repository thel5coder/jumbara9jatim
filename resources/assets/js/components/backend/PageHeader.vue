<template>
    <div>
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>
                        <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{pageTitle}}</span> - {{pageSection}}
                        <div v-show="welcome">
                            <h3 v-if="$auth.user().user_level_id == 1" class="display-block">Selamat datang , {{$auth.user().name }} !</h3>
                            <h3 v-else class="display-block">Selamat datang ,Kontingen {{$auth.user().name }} !</h3>
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
    export default {
        props:{
            welcome:Boolean,
            pageTitle:String,
            pageSection:String,
            breadcrumbItems: Array,
            headingItems:Array,
            activeSection:String
        }
    }
</script>

<style scoped>

</style>