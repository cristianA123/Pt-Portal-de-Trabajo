
<template>
    <v-dialog v-model="dialog" width="600">
      <v-card>
        <v-form
          ref="formNewAgenda"
          lazy-validation
          @submit.prevent="save()"
        >
  
          <v-card-title class="pa-2">
            Crear Trabajo
            <v-spacer></v-spacer>
            <v-btn icon @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-title>
  
          <v-divider></v-divider>
  
          <!-- task form -->
          <div>
            <v-text-field
              v-model="title"
              class="px-2 py-1"
              solo
              flat
              placeholder="Titulo"
              autofocus
              required
            ></v-text-field>

            <v-text-field
              v-model="description"
              class="px-2 py-1"
              solo
              flat
              placeholder="Descripcion"
              outtlined
              required
            ></v-text-field>

            <v-text-field
              v-model="salary"
              class="px-2 py-1"
              solo
              flat
              placeholder="Salario"
              autofocus
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

const emit = defineEmits(['onCreatedJon'])

const { createJob } = usePortal()

    const dialog= ref(false);
    const title= ref('');
    const description= ref('');
    const salary= ref('');
    const formNewAgenda= ref(null);

    const isLoadingAgenda= ref(false);

    const open = ()=> {
        console.log('opem')
        dialog.value = true
    }
    const close = ()=> {
      dialog.value = false
      formNewAgenda.value.reset()
      isLoadingAgenda.value = false
    }
    const save = ()=> {
      if (formNewAgenda.value.validate()) {
        isLoadingAgenda.value = true

          const payload = {
            title: title.value,
            description: description.value,
            salary: salary.value,
          }

          createJob(payload)
            .then((response) => {
              if (response.success) {
                emit('onCreatedJon')
                formNewAgenda.value.reset()
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