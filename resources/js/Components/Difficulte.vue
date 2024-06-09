<template>
    <div class="Inline">
        <b>
            <p style="margin-right:10px"> Difficulté : </p>
        </b>
        <div class="Inline" v-if="this.Difficulte=='facile'"> 
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
            </svg>
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            </svg> 
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            </svg>   
        </div>
        <div class="Inline" v-if="this.Difficulte=='moyen'"> 
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
            </svg>
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
            </svg>
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            </svg>   
        </div>
        <div class="Inline" v-if="this.Difficulte=='difficile'"> 
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
            </svg>
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
            </svg>
            <p style="padding-left:3px"></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
            </svg>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        Difficulte:{
            type: String,
            required: true
        }
    },
    data() {
        return {
            difficulte: this.Difficulte,
        }
    },
    methods: {
        created() {
            console.log('Difficulte.vue created \n');
            console.log("")
            console.log(difficulte)
        }
    }
}
</script>
<style>

.Littlepadding{
    padding-left: 5px;
}

.Bigpadding{
    padding-left: 50px;
}

.Inline{
    display: flex;
}

p{
    font-family: montserrat medium;
    font-size:15px;
}

</style>
