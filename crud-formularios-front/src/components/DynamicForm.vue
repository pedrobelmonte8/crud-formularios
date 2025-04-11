<template>
    <form>
        <div v-for="field in form.campos" :key="field.id">
            <label class="block text-sm/6 font-medium ">{{ field.label }}</label>
            <input :type="field.type" :name="field.name" v-model="data[field.name]" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>



    </form>
</template>

<script setup>
import { reactive, watch } from 'vue'

const props = defineProps({ form: Object })
const data = reactive({})

// Inicializa los campos dinámicos vacíos
watch(() => props.form, (newForm) => {
    if (newForm?.fields) {
        newForm.fields.forEach(field => {
            data[field.name] = ''
        })
    }
}, { immediate: true })
</script>