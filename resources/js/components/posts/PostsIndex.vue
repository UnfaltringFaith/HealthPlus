<template>
  <div class="py-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Посты</h1>
      <div class="flex items-center space-x-4">
        <!-- Кнопка фильтрации -->
        <button @click="showFilters = !showFilters"
          class="flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
            </path>
          </svg>
          Фильтры
        </button>
        <router-link to="/posts/create"
          class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
          Создать пост
        </router-link>
      </div>
    </div>

    <!-- Панель фильтров -->
    <div v-if="showFilters" class="bg-white shadow rounded-lg p-6 mb-6">
      <h3 class="text-lg font-medium text-gray-900 mb-4">Фильтры</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Категория -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
          <select
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="">Все категории</option>
            <option value="health">Здоровье</option>
            <option value="fitness">Фитнес</option>
            <option value="nutrition">Питание</option>
            <option value="mental-health">Психическое здоровье</option>
            <option value="lifestyle">Образ жизни</option>
          </select>
        </div>

        <!-- Статус -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Статус</label>
          <select
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="">Все статусы</option>
            <option value="published">Опубликовано</option>
            <option value="draft">Черновик</option>
            <option value="archived">Архив</option>
          </select>
        </div>

        <!-- Сортировка -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Сортировка</label>
          <select
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="created_at">По дате создания</option>
            <option value="title">По названию</option>
            <option value="view_count">По просмотрам</option>
            <option value="rating">По рейтингу</option>
          </select>
        </div>
      </div>

      <!-- Кнопки действий -->
      <div class="flex justify-end space-x-3 mt-6">
        <button
          class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Сбросить
        </button>
        <button
          class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Применить
        </button>
      </div>
    </div>


    <div class="columns-2 gap-4 ">
      <div class="" v-for="post in posts" :key="post.id">
        <router-link :to="`/posts/${post.id}`">
          <div class="bg-white shadow rounded-lg p-6 mb-4">
            <img v-if="post.image_url" :src="post.image_url" alt="Post Image"
              class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-gray-600 text-xl"> {{ post.title }}</h2>
            <div class="flex justify-between">
              <p class="text-gray-600"> Автор: {{ post.user.name }}</p>
              <p class="text-gray-600"> Просмотры: {{ post.view_count }}</p>
            </div>
          </div>
        </router-link>
      </div>
    </div>
    <div class="flex gap-2 my-4">
      <button :disabled="currentPage === 1" @click="fetchPosts(currentPage - 1)">Back</button>
      <span>{{ currentPage }}</span>
      <button :disable="currentPage === lastPage" @click="fetchPosts(currentPage + 1)">Next</button>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'

const posts = ref([])
const currentPage = ref(1)
const lastPage = ref(10)
const showFilters = ref(false)

onMounted(async () => {
  fetchPosts()
})

const fetchPosts = async (page = 1) => {
  await axios.get(`/api/posts?page=${page}`)
    .then(response => {
      currentPage.value = page
      lastPage.value = response.data.last_page
      posts.value = response.data.data
      console.log('Посты загружены:', posts.value)
    })
    .catch(error => {
      console.error('Ошибка при загрузке постов:', error)
    })
}
</script>
<script setup>
</script>