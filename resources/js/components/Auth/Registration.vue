<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Создать аккаунт
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Или
                    <router-link to="/login" class="font-medium text-blue-600 hover:text-blue-500">
                        войти в существующий аккаунт
                    </router-link>
                </p>
            </div>

            <form @submit.prevent="register" class="mt-8 space-y-6">
                <!-- Имя -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Полное имя
                    </label>
                    <input id="name" v-model="form.name" name="name" type="text" required
                        class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Введите ваше полное имя" />
                    <div v-if="errors.name" class="mt-1 text-sm text-red-600">
                        {{ errors.name[0] }}
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email адрес
                    </label>
                    <input id="email" v-model="form.email" name="email" type="email" autocomplete="email" required
                        class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Введите ваш email" />
                    <div v-if="errors.email" class="mt-1 text-sm text-red-600">
                        {{ errors.email[0] }}
                    </div>
                </div>

                <!-- Пароль -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Пароль
                    </label>
                    <input id="password" v-model="form.password" name="password" type="password"
                        autocomplete="new-password" required
                        class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Введите пароль" />
                    <div v-if="errors.password" class="mt-1 text-sm text-red-600">
                        {{ errors.password[0] }}
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Пароль должен содержать минимум 8 символов
                    </p>
                </div>

                <!-- Подтверждение пароля -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Подтвердите пароль
                    </label>
                    <input id="password_confirmation" v-model="form.password_confirmation" name="password_confirmation"
                        type="password" autocomplete="new-password" required
                        class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Повторите пароль" />
                    <div v-if="errors.password_confirmation" class="mt-1 text-sm text-red-600">
                        {{ errors.password_confirmation[0] }}
                    </div>
                </div>

                <!-- Дата рождения -->
                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700">
                        Дата рождения
                    </label>
                    <input id="birth_date" v-model="form.birth_date" name="birth_date" type="date"
                        class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" />
                    <div v-if="errors.birth_date" class="mt-1 text-sm text-red-600">
                        {{ errors.birth_date[0] }}
                    </div>
                </div>

                <!-- Пол -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Пол
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input v-model="form.gender" type="radio" value="male"
                                class="mr-2 text-blue-600 focus:ring-blue-500" />
                            <span class="text-sm text-gray-700">Мужской</span>
                        </label>
                        <label class="flex items-center">
                            <input v-model="form.gender" type="radio" value="female"
                                class="mr-2 text-blue-600 focus:ring-blue-500" />
                            <span class="text-sm text-gray-700">Женский</span>
                        </label>
                        <label class="flex items-center">
                            <input v-model="form.gender" type="radio" value="other"
                                class="mr-2 text-blue-600 focus:ring-blue-500" />
                            <span class="text-sm text-gray-700">Другой</span>
                        </label>
                    </div>
                    <div v-if="errors.gender" class="mt-1 text-sm text-red-600">
                        {{ errors.gender[0] }}
                    </div>
                </div>

                <!-- Согласие на обработку данных -->
                <div class="flex items-center">
                    <input id="agree_terms" v-model="form.agree_terms" name="agree_terms" type="checkbox" required
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                    <label for="agree_terms" class="ml-2 block text-sm text-gray-900">
                        Я согласен с
                        <a href="#" class="text-blue-600 hover:text-blue-500">условиями использования</a>
                        и
                        <a href="#" class="text-blue-600 hover:text-blue-500">политикой конфиденциальности</a>
                    </label>
                </div>
                <div v-if="errors.agree_terms" class="mt-1 text-sm text-red-600">
                    {{ errors.agree_terms[0] }}
                </div>

                <!-- Общие ошибки -->
                <div v-if="generalError" class="rounded-md bg-red-50 p-4">
                    <div class="text-sm text-red-700">
                        {{ generalError }}
                    </div>
                </div>

                <!-- Кнопка регистрации -->
                <div>
                    <button type="submit" :disabled="loading"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="loading" class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                        {{ loading ? 'Регистрация...' : 'Зарегистрироваться' }}
                    </button>
                </div>
            </form>

            <!-- Дополнительные ссылки -->
            <div class="text-center">
                <router-link to="/" class="text-sm text-blue-600 hover:text-blue-500">
                    ← Вернуться на главную
                </router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/Store/auth'

const router = useRouter()
const authStore = useAuthStore()

// Форма регистрации
const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    birth_date: '',
    gender: '',
    agree_terms: false
})

// Состояние
const loading = ref(false)
const errors = ref({})
const generalError = ref('')

// Функция регистрации
const register = async () => {
    loading.value = true
    errors.value = {}
    generalError.value = ''

    try {
        // Валидация паролей
        if (form.password !== form.password_confirmation) {
            errors.value.password_confirmation = ['Пароли не совпадают']
            return
        }

        // Валидация согласия
        if (!form.agree_terms) {
            errors.value.agree_terms = ['Необходимо согласиться с условиями использования']
            return
        }

        // Подготовка данных для отправки
        const registrationData = {
            name: form.name,
            email: form.email,
            password: form.password,
            password_confirmation: form.password_confirmation,
            birth_date: form.birth_date || null,
            gender: form.gender || null
        }
        console.log('Данные пользователя:', registrationData);

        const response = await axios.post('/api/register', registrationData, {
            headers: {
                'Content-Type': 'application/json'
            }
        });

        // Обработка ответа
        console.log('Ответ:', response.data['auth_token']);

        localStorage.setItem('auth_token', response.data['auth_token']);

        await authStore.register();

        console.log('Текущий статус аутентификации:', authStore.isAuthenticated);

        await new Promise(resolve => setTimeout(resolve, 2000))

        console.log('Регистрация пользователя:', registrationData)

        // Перенаправление после успешной регистрации
        alert('Регистрация прошла успешно! Теперь вы можете войти в систему.')
        router.push('/')

    } catch (error) {
        console.error('Ошибка при регистрации:', error)
        generalError.value = 'Произошла ошибка сети. Попробуйте еще раз.'
    } finally {
        loading.value = false
    }
}
</script>
