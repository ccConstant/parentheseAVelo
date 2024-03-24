<template>
<Navbar></Navbar>
<div class="welcomePage">
    <div>
        <img src="/images/silhouette-stationnement-velo-montagne.jpg" alt="silhouette-stationnement-velo-montagne" class="img-fluid">
    </div>
    <div margin-top="600px">
        <h2> La parenthèse à vélo </h2>
    </div>
</div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
</script>
<style>
.WelcomePage{
    background-color: #e3f2fd;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    
}
</style>
