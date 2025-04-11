<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import FormsSelect from '../components/FormsSelect.vue'
import DynamicForm from '../components/DynamicForm.vue'
import CreateForm from '../components/CreateForm.vue'

const forms = ref([])
const selectedForm = ref(null)

const handleOpenCreateForm = () => {
  showCreateForm.value = true
  selectedForm.value = null
}

const handleFormDeleted = () => {
  selectedForm.value = null
  resetPage();
}

const fetchForms = async () => {
  const res = await axios.get('http://localhost:8000/api/forms')
  forms.value = res.data
}

const getFormById = async (id) => {
    console.log(id);
  const res = await axios.get(`http://localhost:8000/api/forms/${id}`)
  selectedForm.value = res.data
}

const resetPage = () => {
  fetchForms()          // Vuelve a pedir los formularios
  selectedForm.value = null // Limpia el formulario seleccionado
  showCreateForm.value = false // Oculta CreateForm si estaba visible
}

const handleCloseCreateForm = () => {
  showCreateForm.value = false
  fetchForms() // Vuelve a pedir los formularios
}

onMounted(fetchForms);


//Logica para Crear Formulario
const showCreateForm = ref(false)

</script>

<template>
    <label for="form-select" class="block mb-2">Selecciona un formulario:</label>
    <FormsSelect :forms="forms" @formSelected="getFormById" @open-create-form="handleOpenCreateForm" />
    <DynamicForm v-if="selectedForm" :form="selectedForm" @deleted="handleFormDeleted" />
    <CreateForm v-if="showCreateForm && !selectedForm" :form="selectedForm" @close="handleCloseCreateForm" />
  </template>
  
