<template>
<Navbar></Navbar>
<div>
    <p> Liste des parcours </p>
</div>
<Footer></Footer>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
</script>
<script>

/*front fonctionnel*/ 

export default {
    data() {
    },

    created() {
        console.log('Details.vue created');


        
        /*axios.get('/parcours')
            .then(response => {
                console.log(response.data);
            }).catch(() => {
                console.log(Error.message)
            });*/
                
            axios.get('/parcours').then((response) => {
               console.log(response.data);
            }).catch(e => console.log(e))
    }
}


</script>