<template>
    <div class="py-8">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Создать новый пост</h1>

            <div class="bg-white shadow rounded-lg p-6">
                <form @submit.prevent="createPost" class="space-y-6">
                    <!-- Заголовок поста -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Заголовок поста
                        </label>
                        <input id="title" v-model="form.title" type="text" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Введите заголовок поста" />
                    </div>

                    <!-- Содержание поста -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Содержание поста
                        </label>
                        <textarea id="content" v-model="form.content" rows="10" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Введите содержание поста"></textarea>
                    </div>

                    <!-- Категория -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Категория
                        </label>
                        <select id="category" v-model="form.category"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Выберите категорию</option>
                            <option value="health">Здоровье</option>
                            <option value="fitness">Фитнес</option>
                            <option value="nutrition">Питание</option>
                            <option value="mental-health">Психическое здоровье</option>
                            <option value="lifestyle">Образ жизни</option>
                        </select>
                    </div>
                    <!-- Внутри <form> ... -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Вложение (изображение)
                        </label>
                        <input id="image" type="file" @change="onFileChange" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                    </div>

                    <!-- Теги -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                            Теги
                        </label>
                        <input id="tags" v-model="form.tags" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Введите теги через запятую" />
                        <p class="mt-1 text-sm text-gray-500">Разделите теги запятыми (например: здоровье, спорт, диета)
                        </p>
                    </div>

                    <!-- Кнопки управления -->
                    <div class="flex justify-between pt-6">
                        <router-link to="/posts"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Отмена
                        </router-link>

                        <div class="space-x-3">
                            <button type="button" @click="saveDraft" :disabled="loading"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50">
                                Сохранить как черновик
                            </button>

                            <button type="submit" :disabled="loading"
                                class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50">
                                {{ loading ? 'Сохранение...' : 'Опубликовать пост' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const selectedFile = ref(null)

// Форма для создания поста
const form = reactive({
    title: '',
    content: '',
    category: '',
    status: 'draft'
})

// Состояние загрузки
const loading = ref(false)

// Функция для создания поста
const createPost = async () => {
    loading.value = true

    try {
        // Подготовка данных для отправки
        const postData = new FormData();
        for (const key in form) {
            postData.append(key, form[key])
        }
        postData.append('image', selectedFile.value);
        postData.append('tags[]', form.tags.split(',').map(tag => tag.trim()).filter(tag => tag));

        console.log('Создание поста:', postData)
        // Здесь будет API-запрос к Laravel

        const response = await axios.post('/api/posts', postData, {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
            }
        })

        console.log('Пост успешно создан:', response.data);
        

        // Временная имитация успешного сохранения
        await new Promise(resolve => setTimeout(resolve, 1000))


        // Перенаправление на страницу постов после успешного создания
        router.push(`/posts/${response.data.id}`)

    } catch (error) {
        console.error('Ошибка при создании поста:', error)
        alert('Произошла ошибка при создании поста')
    } finally {
        loading.value = false
    }
}

// Функция для сохранения как черновик
const saveDraft = async () => {
    form.status = 'draft'
    await createPost()
}

function onFileChange(event){
    selectedFile.value = event.target.files[0]
    console.log('Выбранный файл:', selectedFile.value);
}
</script>
