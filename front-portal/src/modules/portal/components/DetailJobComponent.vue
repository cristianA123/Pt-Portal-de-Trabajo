
<template>
    <v-dialog v-model="dialog" width="600">
      <v-card>
          <v-card-title class="pa-2">
            Detalle del Trabajo
            <v-spacer></v-spacer>
          </v-card-title>
  
          <v-divider></v-divider>
  
          <!-- task form -->
          <div>
            <div class="flex">
                <h2>Titulo: </h2>
                <p>{{ job.title }}</p>
            </div>
            <div class="flex">
                <h2>Descripcion: </h2>
                <p>{{ job.description }}</p>
            </div>
            <div class="flex">
                <h2>salario: </h2>
                <p>{{ job.salary }}</p>
            </div>
            <div class="flex">
                <h2>Cantidad de postulantes: </h2>
                <p>{{ job.total_postulantes }}</p>
            </div>

            <div>
                <h2>Postulantes: </h2>

                <div v-for="candidate in job.candidates" :key="candidate.id">
                    <p>Nombre: {{ candidate.user.name }}</p>
                    <p>Numero de documento:  {{ candidate.document_number }}</p>
                   
                </div>

            </div>
            <v-divider></v-divider>
          </div>
  
          <v-divider></v-divider>
  
          <v-card-actions class="pa-2">
            <v-btn outlined @click="close">Cancelar</v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
      </v-card>
    </v-dialog>
</template>


<script setup>
import { ref, defineExpose } from 'vue';
import { usePortal } from '@/composables/usePortal';

const { getDetailJob } = usePortal()

    const dialog= ref(false);
    const job= ref({});


    const isLoadingAgenda= ref(false);

    const open = async (job)=> {
        await handleGetDetailJob({job_id: job.id})
        dialog.value = true
    }
    const handleGetDetailJob = async (data) => {
        const response = await getDetailJob(data)
        job.value = response.data
    }
    const close = ()=> {
      dialog.value = false
      isLoadingAgenda.value = false
    }

    defineExpose({
        open,
    })
  
</script>