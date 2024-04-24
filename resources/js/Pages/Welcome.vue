<template>
<Navbar></Navbar>
<div class="welcomePage">
    <div>
        <img src="/images/silhouette-stationnement-velo-montagne.jpg" alt="silhouette-stationnement-velo-montagne" class="img-fluid">
    </div>
</div>
<div class="background">  
    <p> Vous êtes persuadé qu’il est inutile d’aller loin pour aller bien.
Vous êtes plus adepte de l’authentique que de l’exotique.
Vous préférez partager des bons moments avec vos amis plutôt que de leur présenter vos plus belles photos.
Vous nourrissez depuis longtemps l’idée de découvrir les magnifiques paysages de la France à vélo.
Pourtant, vous n’avez jamais réalisé ce projet car c’est compliqué et vous ne savez pas vraiment comment vous y prendre.
Nous sommes là pour vous aider à réaliser ce rêve : appelez nous, on s’occupe de tout ! </p>                          
    <h2> Nos parcours à la une </h2>
    <div class="alignBlock">
        <div v-if="this.parcours.length!=0">
            <div class="alignBlockInline" v-for="(component) in this.parcours" :key="component.key">
                <Parcours :Id=component.id
                            :Titre=component.titre
                            :DureeJours=component.dureeJours
                            :Prix=component.prix
                            :Difficulte=component.difficulte
                            :Description_courte=component.description_courte
                            :Image=component.image
                            :Ville_depart=component.ville_depart
                ></Parcours>
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
        }
    },

    created() {
        console.log('Welcome.vue created');  
        axios.get('/lastparcours').then((response) => {
            this.parcours=response.data;
            console.log("parcours")
            console.log(response.data);
        }).catch(e => console.log(e))
    }
}


</script>

<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import Parcours from '@/Components/Parcours.vue'
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

/*.Bigpadding{
    padding-left: 50px;
}*/

.alignBlockInline{
    margin-top:70px;
    display: inline-block;
}

.alignBlock{
    margin-left: 320px;
    margin-right: auto;
}
.background{
    background-color:blanchedalmond;
    padding-top:40px;
    padding-bottom: 100px;
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
