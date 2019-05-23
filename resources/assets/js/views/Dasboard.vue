<template>
    <div>
        <page-header :page-title="'Beranda'" :page-section="'Ikhtisar'" :welcome="true"
                     :breadcrumb-items="breadcrumbItems" :active-section="activeSection">
        </page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                breadcrumbItems:[],
                activeSection:'Beranda'
            }
        }
    }
</script>

<style scoped>

</style>