<template>
  <Navbar></Navbar>

  <h2>Nos Options</h2>

  <div class="background">
    <div class="backgroundTitle"> 
      <h3>Location de vélo</h3>
    </div>
    <div class="content">
      <img class="image" src="/images/options/VeloLocation.jpeg" alt="Vélo en location">
      <p class="text">
        Vélos à assistance électrique Moustache <br>
        Gravel dimanche 29.2 à guidon plat <br>
        Location à la journée : <b>25€</b>
      </p>
    </div>
  </div>

  <div class="background">
    <div class="backgroundTitle"> 
      <h3>Accompagnateur </h3>
    </div>
    <div class="content">
      <p class="text">
        Accompagnement tout le temps du parcours <br>
        Assistance au guidage et prise en charge de la logistique <br>
        Prix à la journée pour le groupe : <b>250€</b>
      </p>
    </div>
  </div>

  <div class="background">
    <div class="backgroundTitle"> 
      <h3>Drone</h3>
    </div>
    <div class="content">
      <img class="image" src="/images/options/Drone.jpg" alt="Aperçu du drône">
      <p class="text">
        Prises de vues aériennes tout au long du parcours <br>
        Possible uniquement avec l’option « accompagnateur » <br>
        Remise du film sur clé USB <br>
        Prix par groupe pour le parcours complet : <b>150€</b>
      </p>
    </div>
  </div>

  <div class="background">
    <div class="backgroundTitle"> 
      <h3>Organisation de visite</h3>
    </div>
    <div class="content">
      <img class="image" style="height: 230px;" src="/images/options/Visite.jpg" alt="Image de visite">
      <p class="text">
        Organisation de visites pour découvrir des lieux remarquables sur vos parcours <br>
        Prix par personne : <b> prix du billet + 5€ </b>
      </p>
    </div>
  </div>

  <div class="background">
    <div class="backgroundTitle"> 
      <h3>Repas du midi</h3>
    </div>
    <div class="content">
      <img class="image" style="height: 230px;" src="/images/options/RepasMidi.jpg" alt="Image d'exemple de repas">
      <p class="text">
        Réservation du repas du midi proche du lieu où vous souhaitez faire étape <br>
        Menu sans les boissons <br>
        Prix par personne : <b>25€</b>
      </p>
    </div>
  </div>

  <div class="background">
    <div class="backgroundTitle"> 
      <h3>Chambre particulière</h3>
    </div>
    <div class="content">
      <img class="image" style="height: 230px;" src="/images/options/ChambreParticuliere.jpg" alt="Image d'exemple de chambre">
      <p class="text">
        Possibilité de demander une chambre individuelle alors que le tarif des séjours organisés prévoit une chambre pour 2 personnes <br>
        Coût supplémentaire : <b>50€</b>
      </p>
    </div>
  </div>

  <Footer></Footer>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
</script>

<style>
h2 {
  font-size: 50px;
  text-align: center;
  font-family: 'Bebas Neue', sans-serif;
  text-transform: uppercase;
  font-weight: bold;
  padding-top: 20px;
}

.background {
  background-color: #4CAF50;
  margin: 40px;
  padding: 20px;
  border-radius: 10px;
}

.backgroundTitle {
  background-color: white;
  border-radius: 8px;
}

h3 {
  font-family: 'Bebas Neue', sans-serif;
  text-transform: uppercase;
  font-weight: bold;
  margin-bottom: 20px;
}

.content {
  display: flex;
  align-items: center;
}

.image {
  flex: 1;
  margin-right: 20px;
  height: auto;
  max-width: 300px;
  object-fit: cover;
  margin-left: 5%;
}

.text {
  flex: 2;
  font-family: 'Montserrat Medium';
  font-size: 20px;
}

@media (max-width: 768px) {
  .content {
    flex-direction: column;
    align-items: flex-start;
  }
  .image {
    margin: 0 auto 20px auto;
    width: 100%;
    max-width: none;
  }
  .text {
    text-align: center;
    font-size: 18px;
  }
}

@media (max-width: 480px) {
  h2 {
    font-size: 30px;
  }
  .background {
    margin: 20px;
    padding: 10px;
  }
  .text {
    font-size: 16px;
  }
}
</style>
