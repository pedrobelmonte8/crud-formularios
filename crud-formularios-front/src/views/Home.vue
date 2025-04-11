<template>
    <label for="form-select" class="block mb-2">Selecciona un formulario:</label>
    <FormsSelect :forms="forms" @form-selected="getFormById" @open-create-form="handleOpenCreateForm" />
    <DynamicForm v-if="selectedForm && !showUpdateForm" :form="selectedForm" @deleted="handleFormDeleted"
        @edit-form="handleShowUpdateForm" />
    <CreateForm v-if="showCreateForm && !selectedForm" :form="selectedForm" @close="handleCloseCreateForm" />
    <UpdateForm v-if="showUpdateForm" :form="selectedForm" @form-updated="handleFormUpdated"
        @cancel="showUpdateForm = false"></UpdateForm>

</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import FormsSelect from '../components/FormsSelect.vue'
import DynamicForm from '../components/DynamicForm.vue'
import CreateForm from '../components/CreateForm.vue'
import UpdateForm from '../components/UpdateForm.vue'

const forms = ref([])
const selectedForm = ref(null)
const showUpdateForm = ref(false)

const handleOpenCreateForm = () => {
    showCreateForm.value = true
    showUpdateForm.value = false
    selectedForm.value = null
}

const handleFormDeleted = () => {
    selectedForm.value = null
    resetPage();
}

const handleFormUpdated = () => {
    resetPage();
}

const fetchForms = async () => {
    const res = await axios.get('http://localhost:8000/api/forms')
    forms.value = res.data
}

const getFormById = async (id) => {
    resetPage();
    const res = await axios.get(`http://localhost:8000/api/forms/${id}`)
    selectedForm.value = res.data
}

const resetPage = () => {
    fetchForms()          // Vuelve a pedir los formularios
    selectedForm.value = null // Limpia el formulario seleccionado
    showCreateForm.value = false // Oculta CreateForm si estaba visible
    showUpdateForm.value = false // Oculta UpdateForm si estaba visible
}

const handleCloseCreateForm = () => {
    showCreateForm.value = false
    resetPage();
}


const handleShowUpdateForm = () => {
    showCreateForm.value = false
    showUpdateForm.value = true
}

onMounted(fetchForms);


//Logica para Crear Formulario
const showCreateForm = ref(false)

</script>

