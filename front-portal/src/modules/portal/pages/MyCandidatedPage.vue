import { ref } from 'vue';
<template>
    <v-card
      flat
      title="Mis Postulaciones"
    >
      <template v-slot:text>
        <v-text-field
          v-model="search"
          label="Search"
          prepend-inner-icon="mdi-magnify"
          single-line
          variant="outlined"
          hide-details
        ></v-text-field>
      </template>
  
      <v-data-table
        :headers="headers"
        :items="desserts"
        :search="search"
      >

      <template v-slot:no-data>
        <v-btn
          color="primary"
          @click="initialize"
        >
          Reset
        </v-btn>
      </template>
    </v-data-table>
    </v-card>
    <NewJobComponent 
        ref="newJob"
        @onCreatedJon="onCreatedJon"
    />
    <DetailJobComponent 
        ref="detailJob"
        @onCreatedJon="onCreatedJon"
    />
  </template>

<script setup>

import { ref, onMounted } from 'vue';   
import { usePortal } from '@/composables/usePortal';
import NewJobComponent from './../components/NewJobComponent.vue';
import DetailJobComponent from '../components/DetailJobComponent.vue';
import { useAuthStore } from '@/stores/useAuthStore';


const { myApplyJob } = usePortal()
useAuthStore()

const newJob = ref(null)
const detailJob = ref(null)
const search = ref('');
const headers = ref([
        { key: 'title', title: 'Titulo' },
        { key: 'description', title: 'Descripcion' },
        { key: 'salary', title: 'Salario' },
        // { key: 'actions', title: 'Postular' },
       
    ]);
const desserts = ref([]);

onMounted(async () => {
  await handleGetJobs()
})


const handleGetJobs = async () => {
    const response = await myApplyJob()
    desserts.value = response.data
}

const onCreatedJon = async () => {
  await handleGetJobs()
}




</script>
