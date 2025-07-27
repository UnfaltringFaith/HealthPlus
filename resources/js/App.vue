<template>
  <div class="min-h-screen flex flex-col">
    <Header />
    <main class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex-grow">
      <router-view />
    </main>
    <Footer />
  </div>
</template>
<script setup>
import Header from './components/utilites/Header.vue'
import Footer from './components/utilites/Footer.vue'
import { onMounted } from 'vue'
import { useAuthStore } from './Store/auth'

onMounted(async () => {
  const authStore = useAuthStore()
  const user = await authStore.fetchUser() // Fetch user data on mount

  console.log("Fetched user data:", user);

})
</script>