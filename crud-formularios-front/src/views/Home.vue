<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import FormSelect from '../components/FormsSelect.vue'
import DynamicForm from '../components/DynamicForm.vue'

const forms = ref([])
const selectedForm = ref(null)

onMounted(async () => {
  const res = await axios.get('http://localhost:8000/api/forms');
  console.log(res.data);
  forms.value = res.data
})

const getFormById = async (id) => {
    console.log(id);
  const res = await axios.get(`http://localhost:8000/api/forms/${id}`)
  selectedForm.value = res.data
}
</script>

<template>
    <label for="form-select" class="block mb-2">Selecciona un formulario:</label>
    <FormSelect :forms="forms" @formSelected="getFormById" />
    <DynamicForm v-if="selectedForm" :form="selectedForm" />
  </template>
  
