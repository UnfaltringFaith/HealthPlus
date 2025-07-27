import axios from 'axios';
import { defineStore } from 'pinia';
import { useRouter } from 'vue-router';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        isAuthenticated: !!localStorage.getItem('auth_token'),
        user: JSON.parse(localStorage.getItem('user') || 'null'),
    }),
    actions: {
        // Инициализация - только если нет данных пользователя
        async init() {
            if (this.isAuthenticated && !this.user) {
                await this.fetchUser();
            }
        },
        async login({ email, password }) {
            const response = await axios.post('/api/login', {
                'email': email,
                'password': password,
            }, {
                headers: {
                    'Content-Type': 'application/json'
                }
            })

            if (response.status === 200) {
                localStorage.setItem('auth_token', response.data.token);
                this.isAuthenticated = true;

                // Redirect to the dashboard or another page
            }
        },
        async register() {
            this.isAuthenticated = true;
        },
        async logout() {
            const response = await axios.post('/api/logout', {}, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
                },
            });

            if (response.status === 200) {
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user'); // Удаляем данные пользователя
            }

            this.isAuthenticated = false;
            this.user = null;
        },
        async fetchUser() {
            if (!localStorage.getItem('auth_token')) return null;
            
            try {
                const response = await axios.get('/api/user', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
                    },
                });

                if (response.status === 200) {
                    this.user = response.data; // Сохраняем в state
                    localStorage.setItem('user', JSON.stringify(response.data)); // Сохраняем в localStorage
                    return response.data;
                }
            } catch (error) {
                console.error('Error fetching user:', error);
                return null;
            }
        },
    },
});
