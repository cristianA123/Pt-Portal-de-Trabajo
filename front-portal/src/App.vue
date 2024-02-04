<template>
  <v-app>
    <v-main>
      <router-view/>
      <h1 class="text-4xl bg-red-500 ">
        Hello world!
      </h1>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    //
  }),
}
</script>
