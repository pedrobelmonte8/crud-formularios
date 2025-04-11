<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const forms = ref([])
const selectedForm = ref('')

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/forms')
    forms.value = response.data
  } catch (error) {
    console.error('Error cargando formularios:', error)
  }
})
</script>

<template>
  <div>
    <label for="form-select" class="block mb-2">Selecciona un formulario:</label>
    <select v-model="selectedForm" id="form-select" class="border p-2">
      <option disabled value="">-- Selecciona --</option>
      <option v-for="form in forms" :key="form._id" :value="form._id">
        {{ form.nombre }}
      </option>
    </select>

    <div v-if="selectedForm" class="mt-4">
      ID Seleccionado: {{ selectedForm }}
    </div>
  </div>
</template>