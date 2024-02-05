<script setup>

import { ref } from 'vue';
import { useAuth } from '@/composables/useAuth';
import { useRouter } from 'vue-router';


    const router = useRouter()

    const {register} = useAuth();

  const form = ref(null);
  const document_number = ref('9876543');
  const document_type = ref('dni');
  const name = ref('miguel');
  const last_name = ref('casca');
  const birthday = ref('2000-10-10');

  const email = ref('cristian@gmail.com');
  const password = ref('123456');
  const authError = ref(false);
  const passwordType = ref('password');
  const authLoading = ref(false)


  const correoRules = [
    (v) => !!v.trim() && v.length > 0 || 'El correo es requerido',
    (v) => /.+@.+\..+/.test(v) || 'El formato del correo no es válido',
  ];

  const passwordRules = [
    (v) => !!v || 'La contraseña es requerida',
    (v) => (v && v.length >= 6) || 'La contraseña debe tener al menos 8 caracteres',
  ];

  const handleChangePasswordType = async () => {

    if (passwordType.value === 'password') {
      passwordType.value = 'text';
    } else {
      passwordType.value = 'password';
    }
  };

const handleSubmit = async () => {
  const { valid } = await form.value.validate();
  if (valid) {
    try {
      authLoading.value = true
      const payload = {
        document_number: document_number.value,
        document_type: document_type.value,
        name: name.value,
        last_name: last_name.value,
        birthday: birthday.value,
        email: email.value,
        password: password.value,
        role: 'candidate'
      }
      const response = await register(payload)
      if ( response.success ) {
        router.push('/jobs')
        authError.value = false;
        authLoading.value = false
      } else {
        authError.value = true;
        authLoading.value = false
      }
    } catch (error) {
      authError.value = true;
    }
  }
};
</script>

<template>
  <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg text-center">
      <h1 class="text-2xl font-bold sm:text-3xl">Login</h1>
    </div>

    <v-form ref="form" @submit.prevent="handleSubmit" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
      <div>
        <label for="email" class="sr-only">Nombre</label>
        <div class="relative">
          <v-text-field 
          v-model="name" 
          :rules="[(v) => !!v.trim() && v.length > 0 || 'El Nombre es requerido',]"
          label="Nombre" 
          variant="outlined" 
          type="text"
          placeholder="Juan" />
        </div>
      </div>

      <div>
        <label for="email" class="sr-only">Apellido</label>
        <div class="relative">
            <v-text-field 
            v-model="last_name" 
            :rules="[(v) => !!v.trim() && v.length > 0 || 'El Apellido es requerido',]"
            label="Apellido" 
            variant="outlined" 
            type="text"
            placeholder="testuser@example.com"
            />
        </div>
      </div>

      <div>
        <label for="email" class="sr-only">Email</label>
        <div class="relative">
          <v-text-field v-model="email" :rules="correoRules" label="Email" variant="outlined" type="text"
            placeholder="testuser@example.com" />
        </div>
      </div>

      <div>
        <label for="password" class="sr-only">Password</label>

        <div class="relative">
          <v-text-field v-model="password" :type="passwordType" label="Password" variant="outlined" clearable
            :rules="passwordRules" placeholder="testpassword123" />
          <span class="absolute inset-y-4 end-0 grid px-4 " @click="handleChangePasswordType">
            <v-icon icon="mdi-eye-outline" />
          </span>

        </div>
      </div>

      <div>
        <label for="email" class="sr-only">Cumpleaños</label>
        <div class="relative">
            <v-text-field 
            v-model="birthday" 
            :rules="[(v) => !!v.trim() && v.length > 0 || 'El Cumpleaños es requerido',]"
            label="Cumpleaños" 
            variant="outlined" 
            type="text"
            placeholder="testuser@example.com" 
                />
        </div>
      </div>

      <div>
        <label for="email" class="sr-only">Tipo de documento</label>
        <div class="relative">
            <v-text-field 
            v-model="document_type" 
            :rules="[(v) => !!v.trim() && v.length > 0 || 'El Tipo de documento es requerido',]"
            label="Tipo de documento" 
            variant="outlined" 
            type="text"
            placeholder="testuser@example.com" 
            />
        </div>
      </div>
      
      <div>
        <label for="email" class="sr-only">Numero de documento</label>
        <div class="relative">
            <v-text-field 
            v-model="document_number" 
            :rules="[(v) => !!v.trim() && v.length > 0 || 'El Numero de documento es requerido',]"
            label="Numero de documento" 
            variant="outlined" 
            type="text"
            placeholder="testuser@example.com"
                />
        </div>
      </div>

      <div class="flex items-center justify-center">
        <p v-if="authError" class="text-sm text-red-500">
          Verifique su correo y contraseña
        </p>
        <p v-else class="opacity-0">.</p>
      </div>

      <div class="flex items-center justify-center">
        <v-btn 
          type="submit" 
          class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
          :loading="authLoading"
          >
          Crear
        </v-btn>
      </div>
    </v-form>
  </div>
</template>
  