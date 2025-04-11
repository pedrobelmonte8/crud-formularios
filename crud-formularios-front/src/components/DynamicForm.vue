<template>
    <form>
        <div v-for="field in form.campos" :key="field.id">
            <label class="block text-sm/6 font-medium ">{{ field.label }}</label>
            <input :type="field.type" :name="field.name" v-model="data[field.name]" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
        <div class="buttons">
            <button type="button" @click="deleteForm" class="bg-red-500 text-white px-4 py-2 mt-4 rounded">Eliminar formulario</button>
            <button type="button">Actualizar</button>
        </div>


    </form>
</template>

<script setup>
import { reactive, watch } from 'vue'
import { defineProps, defineEmits } from 'vue'
import axios from 'axios'

const props = defineProps({ form: Object }) //recibe el formulario seleccionado
const data = reactive({})

const emit = defineEmits(['deleted'])  // emitiremos esto cuando se borre correctamente

const deleteForm = async () => {
  if (!confirm('¿Seguro que quieres eliminar este formulario?')) return

  try {
    await axios.delete(`http://localhost:8000/api/forms/${props.form.id}`)
    alert('Formulario eliminado correctamente')
    emit('deleted')  // le avisamos al padre (Home.vue) para que limpie selectedForm
  } catch (error) {
    console.error('Error al eliminar:', error)
    alert('Hubo un error al eliminar el formulario')
  }
}

// Inicializa los campos dinámicos vacíos
watch(() => props.form, (newForm) => {
    if (newForm?.fields) {
        newForm.fields.forEach(field => {
            data[field.name] = ''
        })
    }
}, { immediate: true })
</script>