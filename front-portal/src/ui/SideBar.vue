<template>
  <div class="flex h-screen">
    <aside class="w-64 p-4 flex flex-col items-start">
      <figure class="mx-auto">
        <img src="https://img.freepik.com/vector-gratis/arbol-aislado-sobre-fondo-blanco_1308-26130.jpg?w=740&t=st=1707071655~exp=1707072255~hmac=160e1f311003db6e0dead65667ee2cff6be38364af87b21d15598fc9187de189" alt="Logo" class="mb-4" />
      </figure>
      <ul class="text-left" >
        <li  v-for="option in options"
          :key="option.icon"
          @click="onPlaceClick(option)"
          class="flex items-center p-2 cursor-pointer hover:bg-c_gray transition-all w-full ">
          <router-link :to="option.path">  
            <span class="mr-2"><font-awesome :class="(option.path === activePlace) ? 'text-c_primary' : 'text-c_gray_icon'" :icon="option.icon"  /></span>
            <span>{{ option.name }}</span>
          </router-link>
        </li>
      </ul>
      <button @click="logout" class="mt-auto w-full border border-black p-2 rounded-xl font-semibold  ">
        Salir
      </button>
    </aside>
  </div>
</template>

<script >
import { defineComponent, ref } from "vue";
import { menuNavigation } from '../configs/navigation';
// import { useAuth } from '../composables/useAuth';
import { useRouter } from 'vue-router';

export default defineComponent({
  name: "SideBar",
  components: {},
  setup() {
    const router = useRouter()

    // const { logout } = useAuth()
    const isSelected = ref(true);
    const activePlace = ref('');
    const options = menuNavigation

    

    return {
      isSelected,
      options,
      activePlace,
      onPlaceClick: (place) => { 
                activePlace.value = place.path
            },
      logout: () => {
        // logout()
        router.push('/auth/login')
      },
    };
  },
});
</script>

<style scoped></style>
