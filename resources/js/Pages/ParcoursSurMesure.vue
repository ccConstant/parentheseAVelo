<template>
    <Head title="Parcours sur mesure" />
    <Navbar></Navbar>
    
    <h2>Un parcours sur mesure ? Remplissez le questionnaire !</h2>
    <div class="container">
        <iframe class="centered"
        id="Questionnaire de parcours sur mesure"
        title="Questionnaire de parcours sur mesure"
        width="100%"
        height="4000"
        src="https://docs.google.com/forms/d/e/1FAIpQLSdGyKrQO2D3YyXcC00pJgeuw0Lj9p31cCBIq3GPqzS8Gayt7g/viewform?usp=sf_link">
        </iframe>
    </div>
    <Footer></Footer>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import { Head } from '@inertiajs/vue3'
</script>

<style scoped>
.container {
    margin-top: 50px;
    margin-bottom: 50px;
    padding: 0 15px;
}

.centered {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    height: 1000px;
}

h2 {
    font-size: 2.5rem; /* Utiliser des unités relatives */
    text-align: center;
    font-family: 'Bebas Neue', sans-serif;
    font-weight: bold;
    margin-top: 30px;
}

/* Media queries pour ajuster les styles sur différents appareils */
@media (max-width: 768px) {
    h2 {
        font-size: 2rem;
    }

    .container {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    iframe {
        height: 1500px; /* Ajuster la hauteur de l'iframe pour les petits écrans */
    }
}

@media (max-width: 480px) {
    h2 {
        font-size: 1.5rem;
    }

    iframe {
        height: 1000px; /* Ajuster la hauteur de l'iframe pour les très petits écrans */
    }
}
</style>
