<template>
  <div class="upload-container" style="margin-top:50px;">
    <div v-if="props.is_plan">
      <h3>Télécharger le plan du parcours</h3>
    </div>
    <div v-else>
      <h3>Télécharger une image</h3>
    </div>
    <form @submit.prevent="uploadImage">
      <input type="file" @change="onFileChange" :disabled="imageUrl != ''" />
      <div v-if="!props.is_plan">
        <label>
          <input type="checkbox" v-model="isMainImage" :disabled="imageUrl != ''"/> Est-ce l'image principale?
        </label>
        <div class="mb-3">
          <label for="alt" class="form-label">Texte alternatif </label>
          <input type="text" class="form-control custom-input" id="alt" v-model="form.alt" :disabled="imageUrl != ''">
          <div v-if="errors.alt" class="text-danger">{{ errors.alt[0] }} </div>
        </div>
      </div>
      <button type="submit" :disabled="imageUrl != ''" class="btn custom-btn">Télécharger</button>
    </form>
    <div v-if="imageUrl">
      <h3>Image téléchargée :</h3>
      <img :src="imageUrl" alt="Uploaded Image" />
    </div>
    <div v-if="errors.length">
      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const file = ref(null);
const imageUrl = ref('');
const imageUrlAttribute = ref('');
const errors = ref({});
const isMainImage = ref(false);
const verif = ref(true);

const props = defineProps({
  parcours_id: {
    type: Number,
    required: true
  },
  is_plan: {
    type: Boolean,
    required: true
  }
});

const form = ref({
  alt: ''
});

const onFileChange = (event) => {
  file.value = event.target.files[0];
};

const uploadImage = async () => {
  if (!file.value) {
    errors.value = ['Veuillez sélectionner un fichier.'];
    return;
  }

  // Reset errors before validation
  errors.value = {};

  const formData = new FormData();
  formData.append('image', file.value);
  formData.append('parcours_id', props.parcours_id);
  formData.append('is_main', isMainImage.value);

  if (!props.is_plan) {
    try {
    // Validate the image alt text first
      const verifResponse = await axios.post('/image/verif', {
        alt: form.value.alt
      });

      verif.value = true; // Set verif to true if validation is successful
    } catch (error) {
      console.error(error);
      errors.value = error.response.data.errors;
      verif.value = false; // Set verif to false if there's an error
      return; // Exit if there's a validation error
    }
  }

  if (verif.value) {
    try {
      console.log('Envoi du formulaire de téléchargement');
      const response = await axios.post('/upload-image', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
      });
      console.log('Réponse reçue:', response);
      imageUrl.value = `/storage/images/${response.data.image_name}`;
      imageUrlAttribute.value = response.data.image_name;
      errors.value = [];
    } catch (error) {
      console.error('Erreur lors du téléchargement:', error);
      if (error.response && error.response.data.errors) {
        errors.value = Object.values(error.response.data.errors).flat();
      } else {
        errors.value = ['Une erreur est survenue lors du téléchargement.'];
      }
      return; // Exit if there's an error during upload
    }

    // Perform additional actions after a successful image upload
    try {
      if (props.is_plan) {
        await axios.post('/parcours/addPlan', {
          id: props.parcours_id,
          plan_parcours: imageUrlAttribute.value
        });
        console.log("Parcours add plan");
      } else {
        console.log("Parcours add image deb");
        await axios.post('/image/verifOnlyOneMain', {
          parcours_id: props.parcours_id
        });
        console.log("Parcours verif only one main");
        console.log("alt'"+form.value.alt+"'");
        await axios.post('/image/add', {
          parcours_id: props.parcours_id,
          path: imageUrlAttribute.value,
          main: isMainImage.value,
          alt: form.value.alt
        });
        console.log("Parcours add image reussi");
      }
    } catch (error) {
      console.error('Erreur lors de l\'action supplémentaire:', error);
    }
  }
};
</script>

<style scoped>
.upload-container {
  max-width: 500px;
  margin: auto;
}
img {
  max-width: 100%;
  height: auto;
  margin-top: 10px;
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