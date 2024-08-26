<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  parcours_id: {
    type: Number,
    required: true
  },
  is_plan: {
    type: Boolean,
    required: true
  },
  path: {
    type: String,
    default: ''
  },
  id_image: {
    type: Number,
    default: null
  },
  main: {
    type: Number,
    default: 0
  },
  alt: {
    type: String,
    default: 'Uploaded Image'
  }
});

const form = ref({
  alt: props.alt,
  main: props.main
});

console.log("parcours_id"+props.parcours_id);
console.log("is_plan"+props.is_plan);

const file = ref(null);
const imageUrl = ref('');
const imageUrlAttribute = ref('');
const errors = ref([]);
const isMainImage = ref(false);
const verif = ref(true);

// Watch to keep form.main in sync with props.main
watch(
  () => props.main,
  (newVal) => {
    if (newVal===1){
      form.value.main=true ;
    }else{
      form.value.main=false;
    }

  },
  { immediate: true } // This will immediately invoke the watch callback with the initial value
);

const supprimerImage = () => {
  if (confirm("Êtes-vous sûr de vouloir supprimer cette image ?")) {
    axios.post('/image/delete', {
      id: props.id_image,
      parcours_id: props.parcours_id
    }).then(response => {
      console.log(response);
      alert("Image supprimée avec succès !");
      window.location.reload();
    }).catch(error => {
      console.error(error);
    });
  }
};
const updateImage = () => {
  console.log("updateImage");
  // Reset errors before validation
  errors.value = {};
  // Validate the image alt text first
  axios.post('/image/verif', {
    alt: form.value.alt
  })
  .then(response => {
    errors.value = {};
  })
  .catch(error => {
    errors.value = error.response.data.errors;
    console.error(errors.value);
    verif.value = false; // Set verif to false if there's an error
    return;
  });
  if (verif.value) {
    let main=0;
    if (form.value.main){
      main=1;
    }
    console.log("main"+main);
    axios.post('/image/update',{
      id: props.id_image,
      alt: form.value.alt,
      main: main
    })
    .then(response => {
      alert("Image modifiée avec succès !");
    })
    .catch(error => {
      console.error(error);
    });
    if (!props.is_plan){
      // Perform additional actions after a successful image upload
      console.log("Parcours add image deb");
      console.log("props.parcours_id"+props.parcours_id);
      axios.post('/image/verifOnlyOneMain', {
        parcours_id: props.parcours_id
      })
      .then(response => {
        console.log("Parcours add image fin");
      })
      .catch(error => {
        console.error(error);
      });
    }
  }
};

console.log("path" + props.path);
</script>

<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900"> 
          <div class="container mt-5">
            <h2>Modifier une image</h2>
            <form @submit.prevent="updateImage">
              <div v-if="is_plan==true">
                <img :src="path" alt="Plan du parcours" />
              </div>
              <div v-else>
                <img :src="path" :alt="alt" />
              </div>
              <div v-if="!props.is_plan">
                <label>
                  <input type="checkbox" class="custom-input" v-model="form.main"/> Est-ce l'image principale?
                </label>
                <div class="mb-3">
                  <label for="alt" class="form-label">Texte alternatif </label>
                  <input type="text" class="form-control custom-input" id="alt" v-model="form.alt">
                  <div v-if="errors.alt" class="text-danger">{{ errors.alt[0] }} </div>
                </div>
              </div>  
              <!-- Conteneur pour les boutons -->
              <div class="button-container">
                <button type="submit" class="btn custom-btn">Modifier l'image</button>
                <button @click.prevent="supprimerImage" class="btn custom-btn">Supprimer Image</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.upload-container {
  max-width: 500px;
  margin: auto;
}
img {
  max-width: 70%;
  height: auto;
  margin-top: 10px;
}

/* Nouveau style pour aligner les boutons */
.button-container {
  display: flex; /* Utilise flexbox pour aligner les boutons côte à côte */
  gap: 10px; /* Espace entre les boutons */
  margin-top: 20px; /* Espace entre le formulaire et les boutons */
}

.custom-btn {
  background-color: black; /* Couleur de fond personnalisée */
  border-color: black; /* Couleur de bordure personnalisée */
  color: white; /* Couleur du texte */
  flex: 1; /* Facultatif : les boutons auront la même largeur */
  text-align: center; /* Aligne le texte au centre */
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
</style>
