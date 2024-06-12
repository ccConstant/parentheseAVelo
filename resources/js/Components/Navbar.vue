<template>
  <div class="nav sticky-top top-0 left-0 right-0" style="background-color: #000000;">
    <nav class="navbar navbar-stick gap-3 px-2 container" style="background-color: #000000;">
      <a href="/" class="navbar-brand primary-color" style="color:white;">Accueil</a>
      <div class="d-lg-none">
        <i @click="showNavBarLinks = !showNavBarLinks" class="fa-solid fa-bars icon toggle-icon"></i>
      </div>
      <div v-if="showNavBarLinks" class="d-flex gap-5">
        <a :href="link.link" v-for="(link, index) in links" :key="index" class="nav-link" @click="clickedLink = index" :style="index == clickedLink ? 'color:deepskyblue;' : 'color:white;'">{{ link.nom }}</a>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const links = [
  { nom: 'NOS PARCOURS ORGANISÉS', link: '/list' },
  { nom: 'NOS PARCOURS SUR MESURE', link: '/parcoursSurMesure' },
  { nom: 'NOS OPTIONS', link: '/options' }
];

const showNavBarLinks = ref(true);

addEventListener("resize", (e) => {
  if (window.innerWidth > 1020)
    showNavBarLinks.value = true;
  else if (showNavBarLinks.value == true) {
    showNavBarLinks.value = false;
  }
});
</script>

<style scoped>
.nav {
  z-index: 100;
}
a {
  font-family: bebas neue;
  font-size: 15px;
}
.toggle-icon {
  color: white; /* Définit la couleur du toggle en blanc */
  font-size: 24px; /* Vous pouvez ajuster la taille de l'icône si nécessaire */
}
</style>
