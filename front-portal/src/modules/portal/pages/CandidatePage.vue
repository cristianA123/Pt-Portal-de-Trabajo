import { ref } from 'vue';
<template>
    <v-card
      flat
      title="Candidatos"
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
    />
    <ApplyJob 
        ref="newApplyJob"
        @onApplyJob="onApplyJob"
    />
  </template>

<script setup>

import { ref, onMounted } from 'vue';
import { usePortal } from '@/composables/usePortal';
import NewJobComponent from './../components/NewJobComponent.vue';
import DetailJobComponent from '../components/DetailJobComponent.vue';
import { useAuthStore } from '@/stores/useAuthStore';
import ApplyJob from '../components/ApplyJob.vue';


const { getJobs } = usePortal()
useAuthStore()

const newJob = ref(null)
const detailJob = ref(null)
const newApplyJob = ref(null)
const search = ref('');
const headers = ref([
        { key: 'document_number', title: 'Titulo' },
        { key: 'document_type', title: 'Descripcion' },
        { key: 'salary', title: 'Salario' }
    ]);
const desserts = ref([]);

onMounted(async () => {
  await handleGetJobs()
})

const handleGetJobs = async () => {
    const response = await getJobs()
    desserts.value = response.data
}

const onCreatedJon = async () => {
  await handleGetJobs()
}

const onApplyJob = async () => {
  await handleGetJobs()
}


</script>
