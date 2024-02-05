
<template>
    <v-dialog v-model="dialog" width="600">
      <v-card>
        <v-form
          ref="formNewApplly"
          lazy-validation
          @submit.prevent="save()"
        >
  
          <v-card-title class="pa-2">
            Aplycar a Trabajo
            <v-spacer></v-spacer>
            <v-btn icon @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-title>
  
          <v-divider></v-divider>
  
          <!-- task form -->
          <div>
            <v-text-field
              v-model="cv"
              class="px-2 py-1"
              solo
              flat
              placeholder="CV"
              autofocus
              required
            ></v-text-field>

            <v-text-field
              v-model="msg"
              class="px-2 py-1"
              solo
              flat
              placeholder="Mensaje"
              outtlined
              required
            ></v-text-field>
  
            <v-divider></v-divider>
          </div>
  
          <v-divider></v-divider>
  
          <v-card-actions class="pa-2">
            <v-btn outlined @click="close">Cancelar</v-btn>
            <v-spacer></v-spacer>
            <v-btn 
              color="primary" 
              type="submit"
              :loading="isLoadingAgenda"
            >Guardar</v-btn>
          </v-card-actions>
  
        </v-form>
      </v-card>
    </v-dialog>
</template>


<script setup>
import { ref, defineExpose, defineEmits } from 'vue';
import { usePortal } from '@/composables/usePortal';

const emit = defineEmits(['onApplyJob'])

const { applyJob } = usePortal()

    const dialog= ref(false);
    const cv= ref('');
    const jobApply= ref({});
    const msg= ref('');

    const formNewApplly= ref(null);

    const isLoadingAgenda= ref(false);

    const open = (job)=> {
        console.log('opem')
        jobApply.value = job
        dialog.value = true
    }
    const close = ()=> {
      dialog.value = false
      formNewApplly.value.reset()
      isLoadingAgenda.value = false
    }
    const save = ()=> {
      if (formNewApplly.value.validate()) {
        isLoadingAgenda.value = true

          const payload = {
            job_id: jobApply.value.id,
            cv: cv.value,
            msg: msg.value,
          }

          applyJob(payload)
            .then((response) => {
              if (response.success) {
                emit('onApplyJob')
                formNewApplly.value.reset()
                close()
              }
            })
            .catch ( () => {
              isLoadingAgenda.value = false
            })
      }
    }

    defineExpose({
        open,
    })
  
</script>