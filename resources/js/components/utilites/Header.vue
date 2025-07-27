<template>
    <header class="bg-white shadow-lg">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <router-link to="/" class="text-2xl font-bold text-blue-600">
                            HealthPlus
                        </router-link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-8 items-center">
                        <router-link to="/"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                            Главная
                        </router-link>
                        <router-link to="/posts"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                            Посты
                        </router-link>
                        <router-link to="/about"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                            О нас
                        </router-link>
                    </div>
                </div>

                <!-- Right side buttons - Неаутентифицированный пользователь -->
                <div v-if="!authStore.isAuthenticated" class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                    <router-link to="/login"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Войти
                    </router-link>
                    <router-link to="/register"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">
                        Регистрация
                    </router-link>
                </div>

                <!-- Right side buttons - Аутентифицированный пользователь -->
                <div v-if="authStore.isAuthenticated" class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                    <!-- Уведомления -->
                    <button class="p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-full">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-5 5-5-5h5V3h5v14z" />
                        </svg>
                    </button>

                    <!-- Профиль пользователя -->
                    <div class="relative">
                        <button @click="profileMenuOpen = !profileMenuOpen"
                            class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <!-- Аватар -->
                            <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center">
                                <span class="text-sm font-medium text-white">JD</span>
                            </div>
                            <!-- Имя и стрелка -->
                            <div class="flex items-center space-x-1">
                                <span class="text-sm font-medium text-gray-700">{{ authStore.user?.name || 'Пользователь' }}</span>
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <!-- Dropdown меню профиля -->
                        <div v-show="profileMenuOpen"
                            class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <!-- Информация о пользователе -->
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm text-gray-500">{{ authStore.user?.email || 'Почта' }}</p>
                                </div>

                                <!-- Меню пользователя -->
                                <router-link to="/profile"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Мой профиль
                                </router-link>

                                <router-link to="/posts/my"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Мои посты
                                </router-link>

                                <router-link to="/settings"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Настройки
                                </router-link>

                                <div class="border-t border-gray-200"></div>

                                <button @click="logout"
                                    class="flex items-center w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100">
                                    <svg class="mr-3 h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Выйти
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="sm:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 p-2 rounded-md">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div v-show="mobileMenuOpen" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <router-link to="/" class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">
                        Главная
                    </router-link>
                    <router-link to="/posts"
                        class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">
                        Посты
                    </router-link>
                    <router-link to="/about"
                        class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">
                        О нас
                    </router-link>
                </div>

                <!-- Мобильное меню для неаутентифицированного пользователя -->
                <div v-if="!isAuthenticated" class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-4 space-y-2 flex-col">
                        <button
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Войти
                        </button>
                        <router-link to="/register"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium text-center">
                            Регистрация
                        </router-link>
                    </div>
                </div>

                <!-- Мобильное меню для аутентифицированного пользователя -->
                <div v-if="isAuthenticated" class="pt-4 pb-3 border-t border-gray-200">
                    <!-- Профиль пользователя в мобильном меню -->
                    <div class="flex items-center px-4 mb-3">
                        <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center">
                            <span class="text-sm font-medium text-white">JD</span>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">asdasd</div>
                        </div>
                    </div>

                    <!-- Меню пользователя -->
                    <div class="space-y-1">
                        <router-link to="/profile"
                            class="flex items-center px-4 py-2 text-base text-gray-500 hover:text-gray-700">
                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Мой профиль
                        </router-link>

                        <router-link to="/posts/my"
                            class="flex items-center px-4 py-2 text-base text-gray-500 hover:text-gray-700">
                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Мои посты
                        </router-link>

                        <router-link to="/settings"
                            class="flex items-center px-4 py-2 text-base text-gray-500 hover:text-gray-700">
                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Настройки
                        </router-link>

                        <button
                            class="flex items-center w-full text-left px-4 py-2 text-base text-red-600 hover:text-red-700">
                            <svg class="mr-3 h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Выйти
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/Store/auth'
import axios from 'axios'
import { reactive } from 'vue'

const router = useRouter()
const mobileMenuOpen = ref(false)
const profileMenuOpen = ref(false)
const authStore = useAuthStore()

onMounted(async () => {
    await authStore.init() // Инициализируем store, который загрузит данные пользователя
})


const logout = async () => {
    try {
        await authStore.logout()
        router.push('/login')
        console.log(authStore.isAuthenticated);
    } catch (error) {
        console.error('Logout failed:', error)
    }
}
</script>
