<template>
<Navbar></Navbar>
<div class="welcomePage">
    <div>
        <img src="/images/silhouette-stationnement-velo-montagne.jpg" alt="silhouette-stationnement-velo-montagne" class="img-fluid">
    </div>
</div>
<div class="background">                            
    <h2> Nos parcours à la une </h2>
    <div class="alignBlock">
        <div class="alignBlockInline" v-for="(component) in this.parcours" :key="component.key">
            <div class="card" style="width: 21rem; ">
               <img class="card-img-top" alt="Card image cap" v-bind:src="component.image">
                <div class="card-body">
                    <h5 class="card-title">{{component.titre}}</h5>
                    <div class="Inline">
                        <p class="Bigpadding"></p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
  <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
</svg>               
                        <b><p v-if="component.dureeJours>1" class="Littlepadding">{{component.dureeJours}} Jours</p>
                        <p v-else class="Littlepadding">{{component.dureeJours}} Jour</p></b>
                        <b><p class="Bigpadding"> Dès {{component.prix}} € </p></b>
                    </div>
                    <div class="Inline">
                        <b><p style="padding-left:75px"> Difficulté : </p></b>
                        <div class="Inline" v-if="component.difficulte=='facile'"> 
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
                        <div class="Inline" v-if="component.difficulte=='moyen'"> 
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
                        <div class="Inline" v-if="component.difficulte=='difficile'"> 
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
                    <p class="card-text">{{component.description_courte}}</p>
                    <!-- TODO METTRE EN PAGE DUREE JOURS, DIFFICULTE et PRIX--> 
                    <a href="#" class="btn btn-light" style="margin-left:100px">Découvrir</a>
                </div>
            </div>
        </div>
    </div>
</div>

<Footer></Footer>
</template>
<script>

/*front fonctionnel*/ 

export default {
    data() {
        return {
            parcours:[],
            images:[]
        }
    },

    created() {
        console.log('Welcome.vue created');  
        axios.get('/parcours/last3').then((response) => {
            this.parcours=response.data;
            console.log(this.parcours);
        }).catch(e => console.log(e))
    }
}


</script>

<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
</script>
<style>
.WelcomePage{
    background-color: #e3f2fd;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);

}
h2{
    font-size: 40px;
    text-align:center;
}

.card{
    background-color:navajowhite;
    margin-left: 40px;
}

.Littlepadding{
    padding-left: 5px;
}

.Bigpadding{
    padding-left: 50px;
}

.Inline{
    display: flex;

}
.alignBlockInline{
    margin-top:70px;
    display: inline-block;
}

.alignBlock{
    margin-left: 250px;
    margin-right: auto;
}
.background{
    background-color:blanchedalmond;
    padding-top:40px;
}
h5{
    font-size:25px;
    font-weight:bold;
}
p{
    text-align: justify;
    padding-bottom:10px;
}
    
</style>
