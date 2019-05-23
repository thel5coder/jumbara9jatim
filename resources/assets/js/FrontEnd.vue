<template>
    <div>
        <nav-bar></nav-bar>
        <router-view></router-view>
        <footer-front></footer-front>
    </div>
</template>

<script>
    import NavBar from './components/frontend/NavBar'
    import Footer from './components/frontend/Footer'
    export default {
        components:{
            'nav-bar':NavBar,
            'footer-front':Footer
        }
    }
</script>

<style>
</style>