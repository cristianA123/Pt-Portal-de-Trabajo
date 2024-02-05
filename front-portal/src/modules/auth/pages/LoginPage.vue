<script setup>

import { ref } from 'vue';
import { useAuth } from '@/composables/useAuth';
import { useRouter } from 'vue-router';


    const router = useRouter()

    const {login} = useAuth();

  const form = ref(null);
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
      const response = await login(email.value, password.value)

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



const redirigirARegistro = () => {

  router.push('/auth/register'); 
};
</script>

<template>
  <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg text-center">
      <h1 class="text-2xl font-bold sm:text-3xl">Login</h1>
    </div>

    <v-form ref="form" @submit.prevent="handleSubmit" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
      <div>
        <label for="email" class="sr-only">Email</label>

        <div class="relative">
          <v-text-field v-model="email" :rules="correoRules" label="Email" variant="outlined" type="text"
            placeholder="testuser@example.com" />

          <span class="absolute inset-y-4 end-0 grid px-4">
            <v-icon icon="mdi-at" />
          </span>
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

      <div class="flex items-center justify-center">
        <p v-if="authError" class="text-sm text-red-500">
          Verifique su correo y contraseña
        </p>
        <p v-else class="opacity-0">.</p>
      </div>

      <div class="flex items-center justify-center">
        <p class="text-sm text-blue-500 cursor-pointer" @click="redirigirARegistro">
          Registrarse
        </p>
      </div>

      <div class="flex items-center justify-center">
        <v-btn 
          type="submit" 
          class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
          :loading="authLoading"
          >
          Iniciar Session
        </v-btn>
      </div>
    </v-form>
  </div>
</template>
  