<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Parcours from '@/Components/Parcours.vue'
</script>

<template>
    <Head title="Gérer les parcours" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gérer les parcours</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"> 
                        <div class="alignBlock">
                            <div class="alignBlockInline" v-for="(component) in parcours" :key="component.id">
                                <Parcours :Id=component.id
                                            :Titre=component.titre
                                            :DureeJours=component.dureeJours
                                            :Prix=component.prix
                                            :Difficulte=component.difficulte
                                            :Description_courte=component.description_courte
                                            :Image=component.image
                                            :Ville_depart=component.ville_depart
                                            :Delete=true
                                            @remove="removeParcours"
                                ></Parcours>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            parcours:[],
        }
    },
    created() {
        console.log('List.vue created');
        axios.get('/parcours').then((response) => {
            this.parcours=response.data;
        }).catch(e => console.log(e))
    },
    methods: {
      removeParcours(id) {
          if (confirm("Êtes-vous sûr de vouloir supprimer ce parcours ?")) {
              console.log("remove parcours");
              console.log(id);
              console.log(this.parcours);
              axios.post('/parcours/delete', {
                  id: id
              }).then(response => {
                  console.log(response);
                  for (let i = 0; i < this.parcours.length; i++) {
                      if (this.parcours[i].id === id) {
                          console.log("found");
                          console.log(this.parcours[i]);
                          console.log(this.parcours.length);
                          this.parcours.splice(i, 1);
                          this.parcours = [...this.parcours]; 
                          console.log(this.parcours.length);
                          break;
                      }
                  }
              }).catch(error => {
                  console.error(error);
              });
          } else {
              console.log("Suppression annulée");
          }
      }
  }
}

</script>
<style scoped>
h2 {
  font-size: 2.5rem; /* Utilisation d'unités relatives */
  text-align: center;
  font-family: 'Bebas Neue', sans-serif;
  text-transform: uppercase;
  font-weight: bold;
  padding-top: 20px;
  margin: 0 20px; /* Ajout de marges latérales pour les petits écrans */
}

.alignBlockInline {
  margin: 20px; /* Ajout de marge pour espacer les éléments */
  display: flex;
  justify-content: center;
  width: 100%; /* Prendre toute la largeur disponible */
  box-sizing: border-box; /* Inclure les marges et les bordures dans la largeur totale */
}

.alignBlock {
  display: flex;
  flex-wrap: wrap; /* Permettre aux éléments de se répartir sur plusieurs lignes */
  justify-content: center; /* Centrer les éléments horizontalement */
  padding: 0 20px; /* Ajout de padding pour les petits écrans */
}

.background {
  background-color: white;
  padding-top: 40px;
  padding-bottom: 100px;
}

h5 {
  font-size: 25px;
  font-weight: bold;
  font-family: 'Bebas Neue', sans-serif;
  padding-bottom: 10px;
}

@media (min-width: 768px) {
  .alignBlockInline {
    width: calc(50% - 40px); /* Deux éléments par ligne avec une marge */
  }
}

@media (min-width: 1024px) {
  .alignBlockInline {
    width: calc(33.33% - 40px); /* Trois éléments par ligne avec une marge */
  }
}
</style>
