<template>
    <div class="p-4 border mt-4 rounded">
        <h2 class="text-lg font-bold mb-2">Crear nuevo formulario</h2>

        <input v-model="formName" placeholder="Nombre del formulario" class="border p-2 w-full mb-4" />

        <div v-for="(field, index) in fields" :key="index" class="mb-2">
            <input v-model="field.label" placeholder="Label" class="border p-1 mr-2" />
            <input v-model="field.name" placeholder="Name" class="border p-1 mr-2" />
            <select v-model="field.type" class="border p-1 text-gray-400 ">
                <option value="text">Texto</option>
                <option value="number">Número</option>
                <option value="email">Email</option>
            </select>
        </div>

        <button @click="addField" class="bg-blue-500 text-white py-1 px-2 rounded mb-4">
            Añadir campo
        </button>

        <div class="flex gap-2">
            <button @click="createForm" class="bg-green-500 text-white py-1 px-4 rounded">
                Guardar
            </button>
            <button @click="$emit('close')" class="bg-gray-400 text-white py-1 px-4 rounded">
                Cancelar
            </button>
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue'
import axios from 'axios'

const emit = defineEmits(['close', 'form-created'])

const formName = ref('')
const fields = ref([{ label: '', name: '', type: 'text' }])

const addField = () => {
    fields.value.push({ label: '', name: '', type: 'text' })
}

const createForm = async () => {
    await axios.post('http://localhost:8000/api/forms', {
        nombre: formName.value,
        campos: fields.value
    })
    //Emite al padre
    alert("El formulario ha sido creado con éxito");
    emit('form-created')
    emit('close')
}
</script>
