
<template>
    <div class="card h-100" style="width: 21rem; background-color:#4CAF50;">
        <img id="imgParcours" class="card-img-top" alt="Card image cap" v-bind:src="image">
        <div class="card-body">
            <h5 class="card-title">{{titre}}</h5>
            <div class="Inline">
                <p class="Bigpadding"></p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                </svg>               
                <b>
                    <p v-if="dureeJours>1" class="Littlepadding">{{dureeJours}} Jours</p></b>
                    <b><p v-if="dureeJours<=1" class="Littlepadding">{{dureeJours}} Jour</p></b>
                    <b><p class="Bigpadding"> Dès {{prix}} € </p></b>
            </div>
            <div class="Inline">
                <b>
                    <p style="padding-left:85px"> Difficulté : </p>
                </b>
                <div class="Inline" v-if="difficulte=='facile'"> 
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
                <div class="Inline" v-if="difficulte=='moyen'"> 
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
                <div class="Inline" v-if="difficulte=='difficile'"> 
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
            <p class="card-text">{{description_courte}}</p>
            <p><b> Ville de départ : {{ville_depart}} </b></p>
            <button class="btn btn-light" @click="redirect" style="margin-left:100px">Découvrir</button>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        Id:{
            type: Number
        },
        Image: {
            type: String
        },
        Titre: {
            type: String
        },
        DureeJours: {
            type: Number
        },
        Prix: {
            type: Number
        },
        Difficulte: {
            type: String
        },
        Description_courte: {
            type: String
        },
        Ville_depart: {
            type: String
        }
    },
    data() {
        return {
            id: this.Id,
            image: this.Image,
            titre: this.Titre,
            dureeJours: this.DureeJours,
            prix: this.Prix,
            difficulte: this.Difficulte,
            description_courte: this.Description_courte,
            ville_depart: this.Ville_depart
            
        }
    },
    created() {
        console.log('Parcours.vue created');
    },
    methods: {
       redirect(){
        window.location.href = "/parcours/"+this.id;
        }
    },
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
#imgParcours{
    height: 230px;
    width: 100%;
    object-fit: cover;
}
p{
    font-family: Montserrat Medium;
    font-size: 15px;
    padding-bottom: 0px;
    text-align: justify;
}
h5 {
  font-size: 25px;
  font-weight: bold;
  font-family: 'Bebas Neue', sans-serif;
  padding-bottom: 10px;
}

</style>

