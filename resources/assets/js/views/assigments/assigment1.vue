<template>
    <div>
        <select slot="assigment1" class="form-control" slot-scope="props">
            <option value="">Pilih</option>
            <option v-for="schedule in schedules" :value="schedule.uuid">{{schedule.taskTitle}}</option>
        </select>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        created(){
            this.$store.dispatch('SchedulesStore/browse',{url:''})
        }
    }
</script>

<style scoped>

</style>