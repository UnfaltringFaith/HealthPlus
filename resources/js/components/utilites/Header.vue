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
            <router-link
              to="/"
              class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm"
            >
              Главная
            </router-link>
            <router-link
              to="/posts"
              class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm"
            >
              Посты
            </router-link>
            <router-link
              to="/about"
              class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm"
            >
              О нас
            </router-link>
          </div>
        </div>

        <!-- Right side buttons - Неаутентифицированный пользователь -->
        <div
          v-if="!authStore.isAuthenticated"
          class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4"
        >
          <router-link
            to="/login"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium"
          >
            Войти
          </router-link>
          <router-link
            to="/register"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium"
          >
            Регистрация
          </router-link>
        </div>

        <!-- Right side buttons - Аутентифицированный пользователь -->
        <div
          v-if="authStore.isAuthenticated"
          class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4"
        >
          <!-- Уведомления -->
          <div class="relative">
            <button
              @click="notificationsMenuOpen = !notificationsMenuOpen"
              class="relative p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-full"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                />
              </svg>
              <!-- Индикатор новых уведомлений -->
              <span
                class="absolute top-0 right-0 h-3 w-3 bg-red-500 rounded-full"
              ></span>
            </button>

            <!-- Dropdown меню уведомлений -->
            <div
              v-show="notificationsMenuOpen"
              class="absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
            >
              <div class="py-1">
                <!-- Заголовок -->
                <div class="px-4 py-3 border-b border-gray-200">
                  <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-gray-900">
                      Уведомления
                    </h3>
                    <button class="text-xs text-blue-600 hover:text-blue-800">
                      Отметить все как прочитанные
                    </button>
                  </div>
                </div>

                <!-- Список уведомлений -->
                <div class="max-h-64 overflow-y-auto">
                  <!-- Уведомление 1 -->
                  <div
                    class="px-4 py-3 hover:bg-gray-50 border-l-4 border-blue-500"
                  >
                    <div class="flex items-start">
                      <div class="flex-shrink-0">
                        <div
                          class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center"
                        >
                          <svg
                            class="h-4 w-4 text-blue-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"
                            />
                          </svg>
                        </div>
                      </div>
                      <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">
                          Новый комментарий к вашему посту
                        </p>
                        <p class="text-sm text-gray-500">
                          Пользователь John Doe оставил комментарий к посту
                          "Здоровое питание"
                        </p>
                        <p class="text-xs text-gray-400 mt-1">2 минуты назад</p>
                      </div>
                    </div>
                  </div>

                  <!-- Уведомление 2 -->
                  <div class="px-4 py-3 hover:bg-gray-50">
                    <div class="flex items-start">
                      <div class="flex-shrink-0">
                        <div
                          class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center"
                        >
                          <svg
                            class="h-4 w-4 text-green-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            />
                          </svg>
                        </div>
                      </div>
                      <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">
                          Ваш пост понравился
                        </p>
                        <p class="text-sm text-gray-500">
                          Пользователю Jane Smith понравился ваш пост "Утренние
                          упражнения"
                        </p>
                        <p class="text-xs text-gray-400 mt-1">15 минут назад</p>
                      </div>
                    </div>
                  </div>

                  <!-- Уведомление 3 -->
                  <div class="px-4 py-3 hover:bg-gray-50">
                    <div class="flex items-start">
                      <div class="flex-shrink-0">
                        <div
                          class="h-8 w-8 bg-yellow-100 rounded-full flex items-center justify-center"
                        >
                          <svg
                            class="h-4 w-4 text-yellow-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"
                            />
                          </svg>
                        </div>
                      </div>
                      <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">
                          Системное уведомление
                        </p>
                        <p class="text-sm text-gray-500">
                          Запланировано техническое обслуживание на завтра с
                          02:00 до 04:00
                        </p>
                        <p class="text-xs text-gray-400 mt-1">1 час назад</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Футер -->
                <div class="border-t border-gray-200 px-4 py-2">
                  <button
                    class="w-full text-center text-sm text-blue-600 hover:text-blue-800"
                  >
                    Показать все уведомления
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Профиль пользователя -->
          <div class="relative">
            <button
              @click="profileMenuOpen = !profileMenuOpen"
              class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors"
            >
              <!-- Аватар -->
              <div
                class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center"
              >
                <img
                  v-if="authStore.user?.avatar_url"
                  :src="authStore.user.avatar_url"
                  alt="Avatar"
                  class="w-full h-full rounded-full object-cover"
                />
              </div>
              <!-- Имя и стрелка -->
              <div class="flex items-center space-x-1">
                <span class="text-sm font-medium text-gray-700">{{
                  authStore.user?.name || "Пользователь"
                }}</span>
                <svg
                  class="h-4 w-4 text-gray-400"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                  />
                </svg>
              </div>
            </button>

            <!-- Dropdown меню профиля -->
            <div
              v-show="profileMenuOpen"
              class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
            >
              <div class="py-1">
                <!-- Информация о пользователе -->
                <div class="px-4 py-3 border-b border-gray-200">
                  <p class="text-sm text-gray-500">
                    {{ authStore.user?.email || "Почта" }}
                  </p>
                </div>

                <!-- Меню пользователя -->
                <router-link
                  to="/profile"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                  <svg
                    class="mr-3 h-4 w-4 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg>
                  Мой профиль
                </router-link>

                <router-link
                  to="/posts/my"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                  <svg
                    class="mr-3 h-4 w-4 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                  </svg>
                  Мои посты
                </router-link>

                <router-link
                  to="/settings"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                  <svg
                    class="mr-3 h-4 w-4 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                  </svg>
                  Настройки
                </router-link>

                <div class="border-t border-gray-200"></div>

                <button
                  @click="logout"
                  class="flex items-center w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100"
                >
                  <svg
                    class="mr-3 h-4 w-4 text-red-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    />
                  </svg>
                  Выйти
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile menu button -->
        <div class="sm:hidden flex items-center">
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 p-2 rounded-md"
          >
            <svg
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile menu -->
      <div v-show="mobileMenuOpen" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
          <router-link
            to="/"
            class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium"
          >
            Главная
          </router-link>
          <router-link
            to="/posts"
            class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium"
          >
            Посты
          </router-link>
          <router-link
            to="/about"
            class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium"
          >
            О нас
          </router-link>
        </div>

        <!-- Мобильное меню для неаутентифицированного пользователя -->
        <div v-if="!isAuthenticated" class="pt-4 pb-3 border-t border-gray-200">
          <div class="flex items-center px-4 space-y-2 flex-col">
            <button
              class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium"
            >
              Войти
            </button>
            <router-link
              to="/register"
              class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium text-center"
            >
              Регистрация
            </router-link>
          </div>
        </div>

        <!-- Мобильное меню для аутентифицированного пользователя -->
        <div v-if="isAuthenticated" class="pt-4 pb-3 border-t border-gray-200">
          <!-- Профиль пользователя в мобильном меню -->
          <div class="flex items-center px-4 mb-3">
            <div
              class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center"
            >
              <span class="text-sm font-medium text-white">JD</span>
            </div>
            <div class="ml-3">
              <div class="text-base font-medium text-gray-800">asdasd</div>
            </div>
          </div>

          <!-- Меню пользователя -->
          <div class="space-y-1">
            <router-link
              to="/profile"
              class="flex items-center px-4 py-2 text-base text-gray-500 hover:text-gray-700"
            >
              <svg
                class="mr-3 h-5 w-5 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
              </svg>
              Мой профиль
            </router-link>

            <router-link
              to="/posts/my"
              class="flex items-center px-4 py-2 text-base text-gray-500 hover:text-gray-700"
            >
              <svg
                class="mr-3 h-5 w-5 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                />
              </svg>
              Мои посты
            </router-link>

            <router-link
              to="/settings"
              class="flex items-center px-4 py-2 text-base text-gray-500 hover:text-gray-700"
            >
              <svg
                class="mr-3 h-5 w-5 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
              Настройки
            </router-link>

            <button
              class="flex items-center w-full text-left px-4 py-2 text-base text-red-600 hover:text-red-700"
            >
              <svg
                class="mr-3 h-5 w-5 text-red-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                />
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
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/Store/auth";
import axios from "axios";
import { reactive } from "vue";

const router = useRouter();
const mobileMenuOpen = ref(false);
const profileMenuOpen = ref(false);
const notificationsMenuOpen = ref(false);
const authStore = useAuthStore();

onMounted(async () => {
  await authStore.init(); // Инициализируем store, который загрузит данные пользователя

  console.log("User: ----", authStore.user);
});

const logout = async () => {
  try {
    await authStore.logout();
    router.push("/login");
  } catch (error) {
    console.error("Logout failed:", error);
  }
};
</script>
