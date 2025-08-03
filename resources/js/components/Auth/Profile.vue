<template>
  <div class="py-8">
    <div class="max-w-4xl mx-auto">
      <!-- Заголовок профиля -->
      <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
        <!-- Фон профиля -->
        <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-600"></div>
        
        <!-- Информация профиля -->
        <div class="px-6 py-6">
          <div class="flex items-center space-x-6">
            <!-- Аватар -->
            <div class="-mt-16 relative">
              <div class="w-24 h-24 bg-white rounded-full border-4 border-white shadow-lg overflow-hidden">
                <img v-if="authStore.user?.avatar_url" :src="authStore.user.avatar_url" alt="Avatar" class="w-full h-full object-cover">
                <div v-else class="w-full h-full bg-gray-300 flex items-center justify-center">
                  <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                  </svg>
                </div>
              </div>
            </div>
            
            <!-- Основная информация -->
            <div class="flex-1">
              <h1 class="text-2xl font-bold text-gray-900">{{ user.name }}</h1>
              <p class="text-gray-600">{{ user.email }}</p>
              <p v-if="user.bio" class="text-gray-700 mt-2">{{ user.bio }}</p>
            </div>
            
            <!-- Кнопка редактирования -->
            <div>
              <button @click.prevent="openEditModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                Редактировать профиль
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- ...existing code... -->

      <!-- Модальное окно редактирования профиля -->
      <div v-if="showEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
          <!-- Заголовок модального окна -->
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-medium text-gray-900">Редактировать профиль</h3>
            <button @click="closeEditModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <form @submit.prevent="updateProfile" class="space-y-6">
            <!-- Загрузка аватара -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Аватар</label>
              <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-300 rounded-full overflow-hidden">
                  <img v-if="editForm.avatar || user.avatar" :src="editForm.avatar || user.avatar" alt="Аватар" class="w-full h-full object-cover">
                  <div v-else class="w-full h-full bg-gray-300 flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                  </div>
                </div>
                <input type="file" @change="onAvatarChange" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
              </div>
            </div>

            <!-- Имя -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Имя</label>
              <input 
                type="text" 
                v-model="editForm.name" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Email -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input 
                type="email" 
                v-model="editForm.email" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Био -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">О себе</label>
              <textarea 
                v-model="editForm.bio" 
                rows="3" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Расскажите о себе...">
              </textarea>
            </div>

            <!-- Кнопки действий -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
              <button 
                type="button" 
                @click="closeEditModal"
                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Отмена
              </button>
              <button 
                type="submit" 
                :disabled="loading"
                class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50">
                {{ loading ? 'Сохранение...' : 'Сохранить' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../../Store/auth';

const user = ref({
  name: '',
  email: '',
  bio: '',
  avatar: '',
  posts_count: 0,
  total_views: 0,
  total_rating: 0
})

const userPosts = ref([])
const userDrafts = ref([])
const activeTab = ref('posts')
const showEditModal = ref(false)
const loading = ref(false)
const selectedAvatarFile = ref(null)
const authStore = useAuthStore();

// Форма для редактирования
const editForm = reactive({
  name: '',
  email: '',
  bio: '',
  avatar: ''
})

function formatDate(dateString) {
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  return new Date(dateString).toLocaleDateString('ru-RU', options)
}

// Открытие модального окна редактирования
function openEditModal() {
  showEditModal.value = true
  editForm.name = user.value.name
  editForm.email = user.value.email
  editForm.bio = user.value.bio || ''
  editForm.avatar = user.value.avatar || ''
  showEditModal.value = true
}

// Закрытие модального окна
function closeEditModal() {
  showEditModal.value = false
  selectedAvatarFile.value = null
  // Сброс формы
  editForm.name = ''
  editForm.email = ''
  editForm.bio = ''
  editForm.avatar = ''
}

// Обработка выбора аватара
function onAvatarChange(event) {
  const file = event.target.files[0]
  if (file) {
    selectedAvatarFile.value = file
    // Предпросмотр изображения
    const reader = new FileReader()
    reader.onload = (e) => {
      editForm.avatar = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

// Обновление профиля
async function updateProfile() {
  loading.value = true
  
  try {
    const formData = new FormData()
    formData.append('name', editForm.name)
    formData.append('email', editForm.email)
    formData.append('bio', editForm.bio)
    
    if (selectedAvatarFile.value) {
      formData.append('avatar', selectedAvatarFile.value)
    }

    const response = await axios.post('/api/profile', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
      }
    })

    // Обновляем локальные данные
    user.value = { ...user.value, ...response.data }
    authStore.fetchUser() // Обновляем данные пользователя в хранилище
    
    // Закрываем модальное окно
    closeEditModal()
    
    // Показываем уведомление об успехе
    alert('Профиль успешно обновлен!')
    
  } catch (error) {
    console.error('Ошибка при обновлении профиля:', error)
    alert('Произошла ошибка при обновлении профиля')
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  try {
    const response = await axios.get('/api/profile', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
      }
    })
    user.value = response.data
    editForm.name = user.value.name
    editForm.email = user.value.email
    editForm.bio = user.value.bio || ''
  } catch (error) {
    console.error('Ошибка загрузки профиля:', error)
  }
})
</script>