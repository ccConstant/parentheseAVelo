<template>
  <Navbar></Navbar>
  <div class="welcomePage">
    <div>
      <img src="/images/home.png" id="imgHome" alt="silhouette-stationnement-velo-montagne" class="img-fluid">
    </div>
  </div>
  <div class="background">
    <p class="home">
      Vous êtes persuadé qu’il est inutile d’aller loin pour aller bien.
      Vous êtes plus adepte de l’authentique que de l’exotique.
      Vous préférez partager des bons moments avec vos amis plutôt que de leur présenter vos plus belles photos.
      Vous nourrissez depuis longtemps l’idée de découvrir les magnifiques paysages de la France à vélo.
      Pourtant, vous n’avez jamais réalisé ce projet car c’est compliqué et vous ne savez pas vraiment comment vous y prendre.
      Nous sommes là pour vous aider à réaliser ce rêve : <b>appelez nous, on s’occupe de tout !</b>
    </p>
    <h2>Nos parcours à la une</h2>
    <div class="alignBlock">
      <div v-if="parcours.length != 0">
        <div class="parcours-container">
          <div class="alignBlockInline" v-for="component in parcours" :key="component.id">
            <Parcours :Id="component.id"
                      :Titre="component.titre"
                      :DureeJours="component.dureeJours"
                      :Prix="component.prix"
                      :Difficulte="component.difficulte"
                      :Description_courte="component.description_courte"
                      :Image="component.image"
                      :Ville_depart="component.ville_depart">
            </Parcours>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer></Footer>
</template>

<script setup>
import axios from 'axios';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import Parcours from '@/Components/Parcours.vue';
</script>

<script>
export default {
  data() {
    return {
      parcours: [],
    }
  },
  created() {
    console.log('Welcome.vue created');
    axios.get('/lastparcours').then((response) => {
      this.parcours = response.data;
      console.log("parcours");
      console.log(response.data);
    }).catch(e => console.log(e));
  }
}
</script>

<style>
.WelcomePage {
  background-color: black;
  padding: 20px;
  margin: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

#imgHome{
  flex: 1;
  max-height: 1005px;
  width: 100%;
  object-fit: cover;
}

h2 {
  font-size: 35px;
  text-align: center;
  font-family: 'Bebas Neue', sans-serif;
  text-transform: uppercase;
  font-weight: bold;
}

.alignBlock {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-left: 0px;
  margin-right: auto;
}

.alignBlockInline {
  margin-top: 70px;
  display: inline-block;
  margin-right: 30px;
}

.parcours-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

.background {
  background-color: white;
  padding-top: 40px;
  padding-bottom: 100px;
}

h5 {
  font-size: 25px;
  font-weight: bold;
  font-family: 'Bebas Neue', sans-serif;
  padding-bottom: 10px;
}

.home {
  text-align: justify;
  padding-bottom: 40px;
  padding-left: 20px;
  padding-right: 20px;
  font-size: 22px;
  font-family: 'Montserrat Medium';
}

p {
  font-family: 'Montserrat Medium';
  font-size: 15px;
}
</style>