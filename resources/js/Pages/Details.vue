<template>
<Head>
  <title>{{ parcours.titre }}</title>
</Head>
  <Navbar></Navbar>
  <div style="margin-bottom:50px">
    <h1>{{parcours.titre}}</h1>

    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    />

    <div class="carousel-container">
      <div class="carousel-slide">
        <img
          v-for="image in parcours.image"
          :key="image.key"
          :src="image[1]"
          id="imgCarousel"
          :alt="image.alt"
        />
      </div>
      <button class="prev" @click="prevSlide">&#10094;</button>
      <button class="next" @click="nextSlide">&#10095;</button>
    </div>
    <div
      class="backgroundDetail"
      v-for="etape in parcours.etapes"
      :key="etape.key"
    >
      <div class="Inline">
        <h3> Jour {{etape.numero_etape}} </h3>
        <svg
          style="margin-left:5%"
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-graph-up-arrow"
          viewBox="0 0 16 16"
        >
          <path
            fill-rule="evenodd"
            d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5"
          />
        </svg>
        <!--40px-->
        <h4 style="margin-left:0.5%"> {{etape.denivele}} m </h4>
        <svg
          style="margin-left:25px"
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-signpost-fill"
          viewBox="0 0 16 16"
        >
          <path
            d="M7.293.707A1 1 0 0 0 7 1.414V4H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h5v6h2v-6h3.532a1 1 0 0 0 .768-.36l1.933-2.32a.5.5 0 0 0 0-.64L13.3 4.36a1 1 0 0 0-.768-.36H9V1.414A1 1 0 0 0 7.293.707"
          />
        </svg>
        <h4 style="margin-left:0.5%"> {{etape.distance}} Km</h4>
      </div>
      <div class="Inline">
        <b>
          <p style="margin-bottom:15px">
            {{etape.ville_depart}} - {{etape.ville_arrivee}}
          </p>
        </b>
      </div>
      <p> {{etape.description}} </p>
    </div>

    <div class="infosG">
      <div class="Inline">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-clock"
          viewBox="0 0 16 16"
        >
          <path
            d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"
          />
          <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"
          />
        </svg>
        <p style="margin-left:2%">
          <b> {{parcours.dureeJours}} jours </b>
        </p>
        <p style="margin-left:5%">
          <b> Dès {{parcours.prix}} € </b>
        </p>
      </div>
      <p style="margin-bottom:15px"></p>
      <Difficulte :Difficulte="parcours.difficulte"></Difficulte>
      <p><b> Dénivelé cumulé :</b> {{parcours.deniveleCumul}} m </p>
      <p><b> Distance moyenne par jour : </b> {{parcours.distance_moy}} Km</p>
    </div>
    <div class="infosG">
      <p>
        <b>Inclus :</b>
      <ul>
        <li>
          {{parcours.dureeNuits}} nuits d'hôtel 2 ou 3 étoiles (tarif sur la
          base d’une chambre double)
        </li>
        <li> Petit déjeuner </li>
        <li> Repas du soir (hors boissons) </li>
        <li> Transfert des bagages entre les différents lieux d’hébergement </li>
        <li> Assistance par téléphone 7/7 jours </li>
        <li> Compteur GPS </li>
      </ul>
      </p>
    </div>
    <div class="infosG">
      <h3> Description </h3>
      <p> {{parcours.description}} </p>
    </div>
    <img
      style=" margin-left : 20px; width:58%"
      v-bind:src="parcours.plan_parcours"
    />
  </div>

  <Footer></Footer>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import Difficulte from '@/Components/Difficulte.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const id = window.location.pathname.split('/')[2];
const parcours = ref([]);
const currentIndex = ref(0);
let slideInterval = null;

const startSlideShow = () => {
  slideInterval = setInterval(() => {
    nextSlide();
  }, 3000); // Change image every 3 seconds
};

const stopSlideShow = () => {
  if (slideInterval) {
    clearInterval(slideInterval);
    slideInterval = null;
  }
};

const prevSlide = () => {
  if (currentIndex.value === 0) {
    currentIndex.value = parcours.value.image.length - 1;
  } else {
    currentIndex.value--;
  }
  updateSlide();
  resetSlideShow();
};

const nextSlide = () => {
  if (currentIndex.value === parcours.value.image.length - 1) {
    currentIndex.value = 0;
  } else {
    currentIndex.value++;
  }
  updateSlide();
  resetSlideShow();
};

const updateSlide = () => {
  const slideWidth = document.querySelector('.carousel-container').clientWidth;
  document.querySelector('.carousel-slide').style.transform = `translateX(-${currentIndex.value * slideWidth}px)`;
};

const resetSlideShow = () => {
  stopSlideShow();
  startSlideShow();
};

onMounted(() => {
  axios.get(`/parcours/get/${id}`).then((response) => {
    parcours.value = response.data;
    startSlideShow(); // Start the slide show once the data is loaded
  }).catch(e => console.log(e));
});

onUnmounted(() => {
  stopSlideShow(); // Clear the interval when the component is unmounted
});
</script>

<style scoped>
.backgroundDetail {
  background-color: #4CAF50;
  float: left;
  padding: 20px;
  margin-top: 15px;
  margin-left: 20px;
  margin-right: 20px;
  margin-bottom: 5px;
  width: 58%;
  border-radius: 10px;
  font-size: 15px;
}

.Inline {
  display: flex;
}

.infosG {
  background-color: #607D8B;
  border-radius: 10px;
  padding: 20px;
  margin-left: 63%;
  margin-top: 15px;
  width: 35%;
}

ul {
  list-style-type: disc;
}

li {
  margin-left: 1%;
}

p {
  text-align: justify;
  font-family: montserrat medium;
  font-size: 15px;
  margin-bottom: 2px;
}

h3 {
  font-size: 18px;
  text-transform: uppercase;
  font-weight: bold;
  margin-bottom: 15px;
  font-family: bebas neue;
}

h4 {
  font-size: 17px;
  font-weight: bold;
  font-family: bebas neue;
}

h1 {
  font-size: 75px;
  text-transform: uppercase;
  font-weight: bold;
  text-align: center;
  font-family: bebas neue;
}

.carousel-container {
  position: relative;
  width: 100%;
  overflow: hidden;
  height: 70vh;
}

.carousel-slide {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.carousel-slide img {
  flex-shrink: 0;
  width: 100%;
  object-fit: fill;
  height: 40%;
}

.prev, .next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: black;
  color: white;
  padding: 20px;
  border: none;
  cursor: pointer;
}

.prev {
  left: 0;
}

.next {
  right: 0;
}
</style>
