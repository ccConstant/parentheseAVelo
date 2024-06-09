<template>
    <Navbar> </Navbar>
    
    <h2> Un parcours sur mesure ? Remplissez le questionnaire ! </h2>
    <div class="container">
        <iframe class="centered"
        id="Questionnaire de parcours sur mesure"
        title="Questionnaire de parcours sur mesure"
        width="1000"
        height="2000"
        src="https://docs.google.com/forms/d/e/1FAIpQLSdGyKrQO2D3YyXcC00pJgeuw0Lj9p31cCBIq3GPqzS8Gayt7g/viewform?usp=sf_link">
        </iframe>
    </div>
    <Footer> </Footer>

</template>
<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
</script>

<style scoped>

.container {
   margin-top:50px;
   margin-bottom:50px;
}

.centered{
    margin-left: auto;
    margin-right: auto;
}
h2{
    font-size: 35px;
    text-align:center;
    font-family: bebas neue;
    font-weight: bold;
    margin-top:30px;

}
</style>