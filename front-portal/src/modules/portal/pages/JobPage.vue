import { ref } from 'vue';
<template>
    <v-card
      flat
      title="Trabajo"
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
        <v-btn 
          v-if="user.role === 'admin'"
          color="primary"
          @click="openNewJob"
        >
        Crear Trabajo
        </v-btn>
      </template>
  
      <v-data-table
        :headers="headers"
        :items="desserts"
        :search="search"
      >
    
       <template v-slot:[`item.actions`]="{ item }">
        <v-icon
          v-if="user.role === 'admin'"
          size="large"
          @click="showDetail(item)"
        >
          mdi-open-in-new
        </v-icon>
        <v-icon
          size="large"
          @click="aplly(item)"
        >
          mdi-send
        </v-icon>
      </template>

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
const store = useAuthStore()

const {user} = store

const newJob = ref(null)
const detailJob = ref(null)
const newApplyJob = ref(null)
const search = ref('');
const headers = ref([
        { key: 'title', title: 'Titulo' },
        { key: 'description', title: 'Descripcion' },
        { key: 'salary', title: 'Salario' },
        { key: 'actions', title: 'Postular' },
       
    ]);
const desserts = ref([]);

onMounted(async () => {
  await handleGetJobs()
})

const openNewJob = () => {
    newJob.value.open();
}

const handleGetJobs = async () => {
    const response = await getJobs()
    desserts.value = response.data
}

const onCreatedJon = async () => {
  await handleGetJobs()
}

const showDetail = async (job) =>{
  detailJob.value.open(job);
}

const aplly = async (job) => {
  newApplyJob.value.open(job);
}

const onApplyJob = async () => {
  await handleGetJobs()
}


</script>
