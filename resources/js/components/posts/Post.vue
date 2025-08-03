<template>
  <div class="py-8">
    <!-- Навигация назад -->
    <div class="mb-6">
      <router-link
        to="/posts"
        class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium"
      >
        <svg
          class="w-4 h-4 mr-2"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M15 19l-7-7 7-7"
          ></path>
        </svg>
        Назад к постам
      </router-link>
    </div>

    <!-- Основной контент поста -->
    <article class="bg-white shadow-lg rounded-lg overflow-hidden">
      <!-- Изображение поста -->
      <div class="h-64 bg-gray-300 overflow-hidden">
        <img
          :src="post.image_url"
          alt="Изображение поста"
          class="w-full h-full object-cover"
        />
      </div>

      <!-- Контент поста -->
      <div class="p-8">
        <!-- Заголовок -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">
          {{ post.title }}
        </h1>

        <!-- Мета информация -->
        <div
          class="flex items-center justify-between mb-6 text-sm text-gray-600"
        >
          <div class="flex items-center space-x-4">
            <!-- Автор -->
            <div class="flex items-center">
              <div
                class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-2"
              >
                <span class="text-white text-sm font-medium">JD</span>
              </div>
              <span>{{ post.user?.name }}</span>
            </div>

            <!-- Дата -->
            <div class="flex items-center">
              <svg
                class="w-4 h-4 mr-1"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                ></path>
              </svg>
              <span>{{ formatDate(post.created_at) }}</span>
            </div>

            <!-- Просмотры -->
            <div class="flex items-center">
              <svg
                class="w-4 h-4 mr-1"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                ></path>
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                ></path>
              </svg>
              <span>1,234 просмотра</span>
            </div>
          </div>

          <!-- Статус и категория -->
          <div class="flex items-center space-x-2">
            <span
              class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium"
            >
              Опубликовано
            </span>
            <span
              class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium"
            >
              Здоровье
            </span>
          </div>
        </div>

        <!-- Теги -->
        <div class="mb-6">
          <div class="flex flex-wrap gap-2">
            <span
              class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
              >#здоровье</span
            >
            <span
              class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
              >#зима</span
            >
            <span
              class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
              >#профилактика</span
            >
            <span
              class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
              >#витамины</span
            >
          </div>
        </div>

        <!-- Содержание поста -->
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
          <p>
            {{ post.content }}
          </p>
        </div>

        <!-- Действия с постом -->
        <div
          class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200"
        >
          <!-- Лайки и рейтинг -->
          <div class="flex items-center space-x-1">
            <button
              @click="like"
              class="flex items-center space-x-1 text-gray-600 hover:text-green-600 transition-colors"
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
                  d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18"
                />
              </svg>
            </button>
            <span> {{ post.rating }}</span>
            <button
              @click="dislike"
              class="flex items-center space-x-1 text-gray-600 hover:text-red-600 transition-colors"
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
                  d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3"
                />
              </svg>
            </button>
          </div>

          <!-- Поделиться -->
          <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-600">Поделиться:</span>
            <button
              class="p-2 text-gray-600 hover:text-blue-600 transition-colors"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"
                />
              </svg>
            </button>
            <button
              class="p-2 text-gray-600 hover:text-blue-600 transition-colors"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </article>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const router = useRoute();
const postId = router.params.id;

const post = ref({});

console.log(router);

onMounted(async () => {
  const response = await axios.get(`/api/posts/${postId}`);

  post.value = response.data;
  console.log(post.value);
});

const like = async () => {
  const response = await axios.post(
    `/api/posts/${postId}/like`,
    {},
    {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
      },
    }
  );

  post.value.rating = response.data.rating;
  console.log("Like button clicked", response.data);
};

const dislike = async () => {
  const response = await axios.post(
    `/api/posts/${postId}/dislike`,
    {},
    {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
      },
    }
  );
  console.log("Dislike button clicked", response.data);
};

function formatDate(dateString) {
  const options = { year: "numeric", month: "long", day: "numeric" };
  return new Date(dateString).toLocaleDateString("ru-RU", options);
}
</script>
