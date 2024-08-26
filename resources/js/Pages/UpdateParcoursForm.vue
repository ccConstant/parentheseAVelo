<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UpdateEtapeForm from '@/Pages/UpdateEtapeForm.vue';
import AddEtapeForm from '@/Pages/AddEtapeForm.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import { ref, watch } from 'vue';
import axios from 'axios';
import UpdateImageForm from '@/Pages/UpdateImageForm.vue';

const parcours_id = ref(null);
const etapes = ref([]);
const images = ref([]);
const errors = ref({});
const parcours = ref([]);
const id = window.location.pathname.split('/')[2];

const form = ref({
  titre: '',
  description: '',
  description_courte: '',
  difficulte: '',
  prix: null,
  plan: '',
});

axios.get(`/parcours/get/${id}`).then((response) => {
    parcours.value = response.data;
    parcours_id.value = response.data.id;
    console.log(parcours.value);
    console.log("parcours id axios"+parcours_id.value);
    console.log(parcours.value.etapes);
}).catch(e => console.log(e));

// Watcher pour surveiller les changements dans `parcours` et mettre à jour `form`
watch(parcours, (newParcours) => {
  form.value.titre = newParcours.titre || '';
  form.value.description = newParcours.description || '';
  form.value.description_courte = newParcours.description_courte || '';
  form.value.difficulte = newParcours.difficulte || '';
  form.value.prix = newParcours.prix || null;
  form.value.plan = newParcours.plan_parcours || '';
});

const submitForm = () => {
  axios.post('/parcours/verif', {
    titre: form.value.titre,
    description: form.value.description,
    description_courte: form.value.description_courte,
    difficulte: form.value.difficulte,
    prix: form.value.prix,
  }).then(response => {
    errors.value = {};
    axios.post('/parcours/update', {
      id: id,
      titre: form.value.titre,
      description: form.value.description,
      description_courte: form.value.description_courte,
      difficulte: form.value.difficulte,
      prix: form.value.prix
    }).then(response => {
      alert("Parcours modifié avec succès !");
    }).catch(error => {
      console.error(error);
    });
  }).catch(error => {
    errors.value = error.response.data.errors;
    console.error(errors.value);
  });
};

const addEtape = () => {
  etapes.value.push({ id: etapes.value.length, parcours_id: parcours_id.value });
};

const addImage = () => {
  images.value.push({ id: images.value.length, parcours_id: parcours_id.value });
};
</script>

<template>
  <Head title="Modifier un parcours" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier un parcours</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900"> 
            <div class="container mt-5">
              <h2>Modifier un parcours</h2>
              <form @submit.prevent="submitForm">
                <div class="mb-3">
                  <label for="titre" class="form-label">Titre</label>
                  <input type="text" class="form-control custom-input" id="titre" v-model="form.titre" required>
                  <div v-if="errors.titre" class="text-danger">{{ errors.titre[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description longue</label>
                  <textarea class="form-control custom-input" id="description" v-model="form.description" rows="5" required></textarea>
                  <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="description_courte" class="form-label">Description courte</label>
                  <textarea class="form-control custom-input" id="description_courte" v-model="form.description_courte" rows="5" required></textarea>
                  <div v-if="errors.description_courte" class="text-danger">{{ errors.description_courte[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="difficulte" class="form-label">Difficulté</label>
                  <select class="form-select custom-input" id="difficulte" v-model="form.difficulte" required>
                    <option value="" disabled>Choisir une difficulté</option>
                    <option value="facile">Facile</option>
                    <option value="moyen">Moyen</option>
                    <option value="difficile">Difficile</option>
                  </select>
                  <div v-if="errors.difficulte" class="text-danger">{{ errors.difficulte[0] }}</div>
                </div>


                <div class="mb-3" style="margin-bottom:50px;">
                  <label for="prix" class="form-label">Prix</label>
                  <input type="number" class="form-control custom-input" id="prix" v-model="form.prix" :disabled="parcours_id !== null" required>
                  <div v-if="errors.prix" class="text-danger">{{ errors.prix[0] }}</div>
                </div>

                <div class="mb-3">
                  <label for="plan" class="form-label">Plan</label>
                     <UpdateImageForm :parcours_id="parcours.id" :is_plan="true" :path="form.plan"/>
                </div>
                  
                <button type="submit" class="btn custom-btn">Modifier le parcours</button>
              </form>

              <div v-for="etape in parcours.etapes" :key="etape.id">
                <UpdateEtapeForm :parcours_id="parcours.id" :ville_depart="etape.ville_depart" :ville_arrivee="etape.ville_arrivee" :distance="etape.distance" :denivele="etape.denivele" :description="etape.description" :numero_etape="etape.numero_etape" :etape_id="etape.id"/>
            </div>
            <div v-for="etape in etapes" :key="etape.id">
              <AddEtapeForm :parcours_id="etape.parcours_id" />
            </div>
            <button @click="addEtape" class="btn custom-btn mt-3">Ajouter étape</button>

            <div v-for="image in parcours.image" :key="image.id">
                <UpdateImageForm :parcours_id="parcours_id" :id_image="image[0]" :is_plan="false" :path="image[1]" :alt="image[2]" :main="image[3]"/>
            </div>
            <div v-for="image in images" :key="image.id">
              <ImageUpload :parcours_id="parcours_id"  :is_plan="false"/>
            </div>
            <button @click="addImage" class="btn custom-btn mt-3">Ajouter image</button>

                 <!-- <ImageUpload :parcours_id="parcours_id"  :is_plan="true"/>-->
               
                
              </div>
            </div>
          </div>
        </div>
      </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.container {
  max-width: 600px;
}

.custom-input {
  background-color: #4CAF50; /* Couleur de fond personnalisée */
  border-color: black; /* Couleur de bordure personnalisée */
  color: black; /* Couleur du texte personnalisée */
}
.custom-input:focus {
    background-color: #45A049; /* Couleur de fond lors du focus */
  border-color: #2E8B57; /* Couleur de bordure lors du focus */
  color: black; /* Couleur du texte lors du focus */
  box-shadow: 0 0 5px rgba(46, 139, 87, 0.5); /* Ombre lors du focus */
  outline: none; /* Supprime la bordure de focus par défaut */
}

.custom-input:disabled {
  background-color: #3E8B47; /* Couleur de fond légèrement plus foncée */
}

.custom-btn {
  background-color: black; /* Couleur de fond personnalisée */
  border-color: black; /* Couleur de bordure personnalisée */
  color: white; /* Couleur du texte */
}
.custom-btn:hover {
  background-color: #333333; /* Couleur de fond lors du hover */
  border-color: #333333; /* Couleur de bordure lors du hover */
  color: white; /* Couleur du texte lors du hover */
}
.custom-btn:focus {
  background-color: #555555; /* Couleur de fond lors du focus */
  border-color: #555555; /* Couleur de bordure lors du focus */
  color: white; /* Couleur du texte lors du focus */
  box-shadow: 0 0 5px rgba(85, 85, 85, 0.5); /* Ombre lors du focus */
  outline: none; /* Supprime la bordure de focus par défaut */
}
.custom-btn:active {
  background-color: #777777; /* Couleur de fond lors de l'active */
  border-color: #777777; /* Couleur de bordure lors de l'active */
  color: white; /* Couleur du texte lors de l'active */
}

.custom-btn:disabled {
  background-color: #3E8B47; /* Couleur de fond légèrement plus foncée */
}
</style>
