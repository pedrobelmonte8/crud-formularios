<template>
    <div>
        <h2 class="text-xl font-bold mb-4">Actualizar Campos</h2>
        <label class="block text-gray-700 font-semibold mb-1">
            Nombre del formulario
        </label>
        <input required v-model="props.form.nombre" type="text" class="w-full border rounded px-3 py-2 mb-2" />
        <div v-for="(field, index) in updatedFields" :key="index" class="mb-4">

            <label class="block text-gray-700 font-semibold mb-1">
                Label
            </label>
            <input required v-model="updatedFields[index].label" type="text"
                class="w-full border rounded px-3 py-2 mb-2" />

            <label class="block text-gray-700 font-semibold mb-1">
                Name
            </label>
            <input required v-model="updatedFields[index].name" type="text"
                class="w-full border rounded px-3 py-2 mb-2" />

            <label class="block text-gray-700 font-semibold mb-1">
                Type
            </label>
            <select required v-model="updatedFields[index].type" class="w-full border rounded px-3 py-2 mb-2">
                <option value="text">Text</option>
                <option value="email">Email</option>
                <option value="number">Number</option>
                <option value="password">Password</option>
                <!-- Puedes agregar más tipos según tus necesidades -->
            </select>
            <!-- Botón eliminar campo -->
            <button @click="removeField(index)" type="button"
                class="bg-red-500 text-white text-sm px-2 py-1 rounded hover:bg-red-600 mt-2">
                Eliminar campo
            </button>
        </div>

        <!-- Botón para añadir un nuevo campo -->

        <div>
            <button @click="addField" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Añadir nuevo campo
            </button>
        </div>
        <div class="flex justify-between my-3"><button @click="updateForm" class="bg-blue-500 text-white px-4 py-2 rounded">
                Guardar cambios
            </button>

            <button @click="$emit('cancel')" class="bg-gray-500 text-white px-4 py-2 rounded ">
                Cancelar
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'


const props = defineProps({
    form: {
        type: Object,
        required: true
    }
})

const updatedFields = ref([])

const emit = defineEmits(['form-updated', 'cancel'])

// Cuando props.form cambie (cuando selecciones un form)
watch(() => props.form, (newForm) => {
    if (newForm && newForm.campos) {
        updatedFields.value = newForm.campos.map(campo => ({
            label: campo.label,
            name: campo.name,
            type: campo.type,
        }))
    }
}, { immediate: true }) // immediate para que lo haga al cargar
const updateForm = async () => {
    await axios.put(`http://localhost:8000/api/forms/${props.form.id}`, {
        nombre: props.form.nombre,
        campos: updatedFields.value
    })
    alert("El formulario ha sido actualizado con éxito")
    emit('form-updated')
}
// Función para añadir un nuevo campo
const addField = () => {
    const newField = {
        label: `Nuevo campo ${updatedFields.value.length + 1}`,  // Etiqueta del nuevo campo
        name: `campo${updatedFields.value.length + 1}`,  // Nombre dinámico del campo
        type: 'text',  // Tipo por defecto
        valor: '',  // Valor inicial vacío
    }
    updatedFields.value.push(newField)
}

const removeField = (index) => {
    updatedFields.value.splice(index, 1)
}
</script>
