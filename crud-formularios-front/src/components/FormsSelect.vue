<template>
    <div>
        <select class="border p-2" @change="$emit('formSelected', $event.target.value)">
            <option class="text-black" v-for="form in forms" :key="form.id" :value="form.id">
                {{ form.nombre }}
            </option>
        </select>
        <button @click="$emit('open-create-form')"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
            Crear Formulario
        </button>
    </div>



</template>

<script setup>
defineProps({ forms: Array });
</script>