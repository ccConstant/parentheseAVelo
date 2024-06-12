<template>
<Navbar></Navbar>



<div class="background">                            
    <h2> Nos parcours organisés </h2>
    <div class="alignBlock">
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
<Footer></Footer>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import Parcours from '@/Components/Parcours.vue'
</script>
<script>

/*front fonctionnel*/ 

export default {
    data() {
        return {
            parcours:[],
        }
    },
    created() {
        console.log('List.vue created');


        
        /*axios.get('/parcours')
            .then(response => {
                console.log(response.data);
            }).catch(() => {
                console.log(Error.message)
            });*/
                
            axios.get('/parcours').then((response) => {
               this.parcours=response.data;
            }).catch(e => console.log(e))
    },
}


</script>
<style scoped>
h2 {
  font-size: 2.5rem; /* Utilisation d'unités relatives */
  text-align: center;
  font-family: 'Bebas Neue', sans-serif;
  text-transform: uppercase;
  font-weight: bold;
  padding-top: 20px;
  margin: 0 20px; /* Ajout de marges latérales pour les petits écrans */
}

.alignBlockInline {
  margin: 20px; /* Ajout de marge pour espacer les éléments */
  display: flex;
  justify-content: center;
  width: 100%; /* Prendre toute la largeur disponible */
  box-sizing: border-box; /* Inclure les marges et les bordures dans la largeur totale */
}

.alignBlock {
  display: flex;
  flex-wrap: wrap; /* Permettre aux éléments de se répartir sur plusieurs lignes */
  justify-content: center; /* Centrer les éléments horizontalement */
  padding: 0 20px; /* Ajout de padding pour les petits écrans */
}

.background {
  background-color: white;
  padding-top: 40px;
  padding-bottom: 100px;
}

@media (min-width: 768px) {
  .alignBlockInline {
    width: calc(50% - 40px); /* Deux éléments par ligne avec une marge */
  }
}

@media (min-width: 1024px) {
  .alignBlockInline {
    width: calc(33.33% - 40px); /* Trois éléments par ligne avec une marge */
  }
}
</style>