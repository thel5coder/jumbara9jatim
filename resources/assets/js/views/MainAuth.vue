<template>
    <div>
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <router-view></router-view>

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>

    </div>
</template>

<script>
    export default {
        created(){
            $('body').addClass('login-container')
        },
        mounted(){
            $('body').addClass('login-container')
        }
    }
</script>

<style scoped>

</style>