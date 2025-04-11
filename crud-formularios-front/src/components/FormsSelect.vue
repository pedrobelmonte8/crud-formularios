<template>
    <div>
    <select class="border p-2" @change="$emit('formSelected', $event.target.value)">
      <option class="text-black" v-for="form in forms" :key="form.id" :value="form.id">
        {{ form.nombre }}
      </option>
    </select>
</div>



  </template>
  
  <script setup>
  defineProps({ forms: Array });
  </script>