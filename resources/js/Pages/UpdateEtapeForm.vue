<script setup>
import { defineProps } from 'vue';
import { ref } from 'vue';
import axios from 'axios';

const etape_id = ref(null);
const errors = ref({});

const props = defineProps({
    parcours_id: {
        type: Number,
        required: true
    }, 
    ville_depart: {
        type: String,
        required: true
    },
    ville_arrivee: {
        type: String,
        required: true
    },
    distance: {
        type: Number,
        required: true
    },
    denivele: {
        type: Number,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    numero_etape: {
        type: Number,
        required: true
    },
    etape_id: {
        type: Number,
        required: true
    }
});

const form = ref({
  ville_depart: props.ville_depart,
  ville_arrivee: props.ville_arrivee,
  distance: props.distance,
  denivele: props.denivele,
  description: props.description,
  numero_etape: props.numero_etape,
});

const submitForm = () => {
  axios.post('/etape/verif', {
    ville_depart: form.value.ville_depart,
    ville_arrivee: form.value.ville_arrivee,
    distance: form.value.distance,
    denivele: form.value.denivele,
    description: form.value.description,
    numero_etape: form.value.numero_etape,
    parcours_id: props.parcours_id
  }).then(response => {
    errors.value = {};
    axios.post('/etape/update', {
      id: props.etape_id,
      ville_depart: form.value.ville_depart,
      ville_arrivee: form.value.ville_arrivee,
      distance: form.value.distance,
      denivele: form.value.denivele,
      description: form.value.description,
      numero_etape: form.value.numero_etape,
      parcours_id: props.parcours_id
    }).then(response => {
        etape_id.value = response.data;
        alert("Etape modifiée avec succès !");
    }).catch(error => {
      console.error(error);
    });
    axios.post('/parcours/maj', {
      id: props.parcours_id,
    }).then(response => {
      console.log("Parcours maj");
    }).catch(error => {
      console.error(error);
    });
  }).catch(error => {
    console.log(error);
    errors.value = error.response.data.errors;
  });
};

const supprimerEtape = () => {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette étape ?")) {
        console.log("remove etape");
        console.log(props.etape_id);
        axios.post('/etape/delete', {
            id: props.etape_id
        }).then(response => {
            console.log(response);
            alert("Etape supprimée avec succès !");
            window.location.reload();
        }).catch(error => {
            console.error(error);
        });
    } else {
        console.log("Suppression annulée");
    }
};

</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="container mt-5">
                        <h2>Modifier une étape</h2>
                        <form @submit.prevent="submitForm">
                        <div class="mb-3">
                            <label for="ville_depart" class="form-label">Ville de départ</label>
                            <input type="text" class="form-control custom-input" id="ville_depart" v-model="form.ville_depart" required>
                            <div v-if="errors.ville_depart" class="text-danger">{{ errors.ville_depart[0] }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="ville_arrivee" class="form-label">Ville d'arrivée</label>
                            <input type="text" class="form-control custom-input" id="ville_arrivee" v-model="form.ville_arrivee" required>
                            <div v-if="errors.ville_arrivee" class="text-danger">{{ errors.ville_arrivee[0] }} </div>
                        </div>
                        <div class="mb-3">
                            <label for="distance" class="form-label">Distance</label>
                            <input type="number" class="form-control custom-input" id="distance" v-model="form.distance" required>
                            <div v-if="errors.distance" class="text-danger">{{ errors.distance[0] }} </div>
                        </div>
                        <div class="mb-3">
                            <label for="denivele" class="form-label">Dénivelé</label>
                            <input type="number" class="form-control custom-input" id="denivele" v-model="form.denivele" required>
                            <div v-if="errors.denivele" class="text-danger">{{ errors.denivele[0] }} </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control custom-input" id="description" v-model="form.description" rows="5" required></textarea>
                            <div v-if="errors.description" class="text-danger">{{ errors.description[0] }} </div>
                        </div>
                        <div class="mb-3">
                            <label for="numero_etape" class="form-label">Numéro étape</label>
                            <input type="number" class="form-control custom-input" id="numero_etape" v-model="form.numero_etape" required>
                            <div v-if="errors.numero_etape" class="text-danger">{{ errors.numero_etape[0] }} </div>
                        </div>
                            
                        <button type="submit" class="btn custom-btn" >Modifier l'étape</button>
                        <button @click="supprimerEtape" class="btn custom-btn" style="margin-left:10px">Supprimer étape</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

/* style vert pour le bouton */
/*.custom-btn {
  background-color: #4CAF50; /* Couleur de fond personnalisée 
  border-color: #388E3C; /* Couleur de bordure personnalisée 
  color: white; /* Couleur du texte 
}
.custom-btn:hover {
  background-color: #45A049; /* Couleur de fond lors du hover 
  border-color: #388E3C; /* Couleur de bordure lors du hover 
  color: white; /* Couleur du texte lors du hover 
}
.custom-btn:focus {
  background-color: #388E3C; /* Couleur de fond lors du focus 
  border-color: #2E7D32; /* Couleur de bordure lors du focus 
  color: white; /* Couleur du texte lors du focus 
  box-shadow: 0 0 5px rgba(56, 142, 60, 0.5); /* Ombre lors du focus 
  outline: none; /* Supprime la bordure de focus par défaut 
}
.custom-btn:active {
  background-color: #2E7D32; /* Couleur de fond lors de l'active 
  border-color: #1B5E20; /* Couleur de bordure lors de l'active 
  color: white; /* Couleur du texte lors de l'active 
}*/

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
