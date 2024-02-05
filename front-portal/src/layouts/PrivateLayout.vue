
<template>
  <div class="flex h-screen">
    <SideBar class="w-64 p-4"/>

    <main class="flex-1">
      <NavBar class="p-4"/>
      <router-view></router-view>
    </main>
  </div>
</template>

<script setup>
import NavBar from './../ui/NavBar.vue';
import SideBar from './../ui/SideBar.vue';
</script>
