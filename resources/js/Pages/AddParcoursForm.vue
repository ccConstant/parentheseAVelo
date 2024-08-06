<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AddEtapeForm from '@/Pages/AddEtapeForm.vue';
import { ref } from 'vue';
import axios from 'axios';

const parcours_id = ref(null);
const etapes = ref([]);
const errors = ref({});

const form = ref({
  titre: '',
  description: '',
  description_courte: '',
  difficulte: '',
  prix: null
});

const submitForm = () => {
  axios.post('/parcours/verif', {
    titre: form.value.titre,
    description: form.value.description,
    description_courte: form.value.description_courte,
    difficulte: form.value.difficulte,
    prix: form.value.prix
  }).then(response => {
    errors.value = {};
    axios.post('/parcours/add', {
      titre: form.value.titre,
      description: form.value.description,
      description_courte: form.value.description_courte,
      difficulte: form.value.difficulte,
      prix: form.value.prix
    }).then(response => {
      alert("Parcours créé avec succès !");
      parcours_id.value = response.data;
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
</script>

<template>
  <Head title="Gérer les parcours" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ajouter un nouveau parcours</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900"> 
            <div class="container mt-5">
              <h2>Créer un nouveau parcours</h2>
              <form @submit.prevent="submitForm">
                <div class="mb-3">
                  <label for="titre" class="form-label">Titre</label>
                  <input type="text" class="form-control custom-input" id="titre" v-model="form.titre" :disabled="parcours_id !== null" required>
                  <div v-if="errors.titre" class="text-danger">{{ errors.titre[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description longue</label>
                  <textarea class="form-control custom-input" id="description" v-model="form.description" rows="5" :disabled="parcours_id !== null" required></textarea>
                  <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="description_courte" class="form-label">Description courte</label>
                  <textarea class="form-control custom-input" id="description_courte" v-model="form.description_courte" rows="5" :disabled="parcours_id !== null" required></textarea>
                  <div v-if="errors.description_courte" class="text-danger">{{ errors.description_courte[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="difficulte" class="form-label">Difficulté</label>
                  <select class="form-select custom-input" id="difficulte" v-model="form.difficulte" :disabled="parcours_id !== null" required>
                    <option value="" disabled>Choisir une difficulté</option>
                    <option value="facile">Facile</option>
                    <option value="moyen">Moyen</option>
                    <option value="difficile">Difficile</option>
                  </select>
                  <div v-if="errors.difficulte" class="text-danger">{{ errors.difficulte[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="prix" class="form-label">Prix</label>
                  <input type="number" class="form-control custom-input" id="prix" v-model="form.prix" :disabled="parcours_id !== null" required>
                  <div v-if="errors.prix" class="text-danger">{{ errors.prix[0] }}</div>
                </div>
                <button type="submit" class="btn custom-btn" :disabled="parcours_id !== null">Créer le parcours</button>
              </form>

              <div v-if="parcours_id">
                <button @click="addEtape" class="btn custom-btn mt-3">Ajouter étape</button>
                <div v-for="etape in etapes" :key="etape.id">
                  <AddEtapeForm :parcours_id="etape.parcours_id" />
                </div>
              </div>
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
