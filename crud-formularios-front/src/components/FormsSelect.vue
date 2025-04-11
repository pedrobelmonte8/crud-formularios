<template>
    <div class="flex items-center justify-between mt-4">
        <select class=" ml-0 border p-2" @change="handleSelectChange">
            <option class="text-black" v-for="form in forms" :key="form.id" :value="form.id">
                {{ form.nombre }}
            </option>
        </select>
        <button @click="$emit('open-create-form')"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ">
            Crear Formulario
        </button>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'

const props = defineProps({
  forms: Array,
})
const emit = defineEmits(['form-selected'])

const selectedFormId = ref('')

// Selecciona automáticamente el primer form SOLO si aún no hay uno seleccionado
watch(() => props.forms, (newForms) => {
  if (newForms.length > 0 && (!selectedFormId.value || !newForms.find(f => f.id == selectedFormId.value))) {
    console.log('Entra')
    selectedFormId.value = newForms[0].id
    emit('form-selected', newForms[0].id)
  }
}, { immediate: true })

const handleSelectChange = (event) => {
    console.log('Entra al select')
    selectedFormId.value = event.target.value
  const selected = props.forms.find(f => f.id == selectedFormId.value)
  emit('form-selected', selected.id)
}

</script>