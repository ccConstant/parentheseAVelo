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
<style>

h2{
    font-size: 50px;
    text-align:center;
    font-family: bebas neue;
    text-transform: uppercase;
    font-weight: bold;
    padding-top: 20px;
}

.card{
    background-color:white;
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
    margin-left: 150px;
    margin-right: auto;
}
.background{
    background-color:white;
    padding-top:40px;
    padding-bottom:100px;
}
h5{
    font-size:25px;
    font-weight:bold;
}
p{
    text-align: justify;
    padding-bottom:0px;
}
    
</style>