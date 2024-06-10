<template>

<div class="nav sticky-top top-0 left-0 right-0" style="background-color: #000000;">
        <nav class="navbar navbar-stick gap-3 px-2 container" style="background-color: #000000;">
          <a href="/" class="navbar-brand primary-color" style="color:white;">Accueil</a>
          <div class="d-lg-none">
            <i @click="showNavBarLinks = !showNavBarLinks" class="fa-solid fa-bars icon"></i>
          </div>
          <div v-if="showNavBarLinks" class="d-flex gap-5 ">
              <a :href="link.link" v-for="(link,index) in links" :key="index" class="nav-link" @click="clickedLink = index" :style="index == clickedLink ? 'color:deepskyblue;' : 'color:white;'">{{ link.nom }}</a>
              
          </div>
          
          
        </nav>
    </div>
<!--<nav class="navbar navbar-expand-lg" style="background-color: #FFFACD">
  <a class="navbar-brand ml-4" href="/">Accueil</a>

  <div>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active ml-4">
        <a class="nav-link" href="/list">Nos parcours organisés</a>
      </li>
      <li class="nav-item ml-4">
        <a class="nav-link" href="#">Nos parcours sur mesure </a>
      </li>
      <li class="nav-item ml-4">
        <a class="nav-link" href="/options">Nos options</a>
      </li>
    </ul>
  </div>
</nav>-->
</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';

const links = [{
  nom: 'NOS PARCOURS ORGANISÉS',
  link: '/list',
}, {
  nom: 'NOS PARCOURS SUR MESURE',
  link: '/parcoursSurMesure',
}, {
  nom: 'NOS OPTIONS',
  link: '/options',
}
]
const showNavBarLinks = ref(true)

addEventListener("resize", (e) => {
    if (window.innerWidth > 1020)
        showNavBarLinks.value = true
    else if(showNavBarLinks.value == true){
        showNavBarLinks.value = false
    }
})

</script>

<!--<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <a href="controleur.php"><img class="logo" src="productimages/livetoeat.jpg"></a>
                    <h1>Les délices de Kam & CC </h1>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <span class="badge badge-pill badge-info"><a class="nav-link active" href="controleur.php?action=list&categorie=2">BISCUITS</a></span>
                        </li>
                        <li class="nav-item">
                            <span class="badge badge-pill badge-info"><a class="nav-link active" href="controleur.php?action=list&categorie=1">BOISSONS</a></span>
                        </li>
                        <li class="nav-item">
                            <span class="badge badge-pill badge-info"><a class="nav-link active" aria-current="page" href="controleur.php?action=list&categorie=3">FRUITS SECS </a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>-->
<style>
.nav{
  z-index: 100;
}
a{
  font-family:bebas neue;
  font-size: 15px;
}
</style>