<template>
  <nav class="h-20">
      <div class="flex items-center justify-end">
          <div class=" w-10 h-10 bg-orange-400 rounded-full flex justify-center items-center mr-2">
           <p class="font-bold text-white text-lg">
            CQ
           </p> 
          </div>
          <p class="font-semibold">Christian Quispe</p>
      </div>
  </nav>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'NavBar',
    components: {

    },
    setup () {
        

        return {}
    }
})
</script>

<style scoped>

</style>