<template>
<Navbar></Navbar>
<div>
    <p> Détails des parcours </p>
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
        return {
             id: window.location.pathname.split('/')[2]
        }
    },

    created() {
        console.log('Details.vue created');
        console.log(this.id);
        const getParcoursUrl = (id) => `/parcours/get/${id}`;
        axios.get(getParcoursUrl(this.id)).then((response) => {
            console.log(response.data);
        }).catch(e => console.log(e))
    }
}


</script>