<template>
    <h1>{{ volume }}</h1>
    
    <button @click="increment">click</button>
    
</template>

<script>
export default {
    data(){
        return {
            volume: 1,
            txt: 'test'
        }
    },


    methods: {
        increment() {
            this.volume++
        }
    },
}
</script>