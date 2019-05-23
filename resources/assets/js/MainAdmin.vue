<template>
    <div>
        <nav-bar></nav-bar>
        <router-view></router-view>
        <footer-admin></footer-admin>
    </div>
</template>

<script>
    import NavBar from './components/NavBar'
    import Footer from './components/FooterAdmin'
    export default {
        components:{
            'nav-bar':NavBar,
            'footer-admin':Footer
        },
    }
</script>

<style scoped>

</style>