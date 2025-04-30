<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
          <home-icon class="h-10 w-10 text-indigo-600" />
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Daftar Akun Baru
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Atau
          <router-link
            to="/login"
            class="font-medium text-indigo-600 hover:text-indigo-500"
            @click.prevent="goToLogin"
          >
            masuk ke akun yang sudah ada
          </router-link>
        </p>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <form class="space-y-6" @submit.prevent="handleRegister">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">
                Nama Lengkap
              </label>
              <div class="mt-1">
                <input
                  id="name"
                  name="name"
                  type="text"
                  autocomplete="name"
                  required
                  v-model="name"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="Nama Lengkap"
                />
              </div>
              <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Email
              </label>
              <div class="mt-1">
                <input
                  id="email"
                  name="email"
                  type="email"
                  autocomplete="email"
                  required
                  v-model="email"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="nama@example.com"
                />
              </div>
              <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
            </div>

            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">
                Password
              </label>
              <div class="mt-1 relative">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  id="password"
                  name="password"
                  autocomplete="new-password"
                  required
                  v-model="password"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="••••••••"
                />
                <button
                  type="button"
                  @click="togglePassword"
                  class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-500"
                >
                  <eye-icon v-if="!showPassword" class="h-5 w-5" />
                  <eye-off-icon v-else class="h-5 w-5" />
                </button>
              </div>
              <p v-if="errors.password" class="mt-1 text-sm text-red-600">{{ errors.password }}</p>
            </div>

            <div>
              <label for="password-confirm" class="block text-sm font-medium text-gray-700">
                Konfirmasi Password
              </label>
              <div class="mt-1">
                <input
                  id="password-confirm"
                  name="password-confirm"
                  :type="showPassword ? 'text' : 'password'"
                  autocomplete="new-password"
                  required
                  v-model="passwordConfirm"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="••••••••"
                />
              </div>
              <p v-if="errors.passwordConfirm" class="mt-1 text-sm text-red-600">{{ errors.passwordConfirm }}</p>
            </div>

            <div class="flex items-center">
              <input
                id="terms"
                name="terms"
                type="checkbox"
                required
                v-model="agreeToTerms"
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
              />
              <label for="terms" class="ml-2 block text-sm text-gray-900">
                Saya setuju dengan
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Syarat dan Ketentuan</a>
              </label>
            </div>
            <p v-if="errors.terms" class="mt-1 text-sm text-red-600">{{ errors.terms }}</p>

            <div>
              <button
                type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                <loader-icon v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" />
                Daftar
              </button>
            </div>
          </form>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">
                  Atau daftar dengan
                </span>
              </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
              <div>
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Sign up with Google</span>
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
                  </svg>
                </a>
              </div>

              <div>
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Sign up with Facebook</span>
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, reactive } from 'vue';
  import { HomeIcon, EyeIcon, EyeOffIcon, LoaderIcon } from 'lucide-vue-next';

  // Form state
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const passwordConfirm = ref('');
  const agreeToTerms = ref(false);
  const showPassword = ref(false);
  const loading = ref(false);
  const errors = reactive({
    name: '',
    email: '',
    password: '',
    passwordConfirm: '',
    terms: ''
  });

  // Toggle password visibility
  const togglePassword = () => {
    showPassword.value = !showPassword.value;
  };

  // Form validation
  const validateForm = () => {
    let isValid = true;
    errors.name = '';
    errors.email = '';
    errors.password = '';
    errors.passwordConfirm = '';
    errors.terms = '';

    // Name validation
    if (!name.value) {
      errors.name = 'Nama diperlukan';
      isValid = false;
    } else if (name.value.length < 2) {
      errors.name = 'Nama harus minimal 2 karakter';
      isValid = false;
    }

    // Email validation
    if (!email.value) {
      errors.email = 'Email diperlukan';
      isValid = false;
    } else if (!/^\S+@\S+\.\S+$/.test(email.value)) {
      errors.email = 'Format email tidak valid';
      isValid = false;
    }

    // Password validation
    if (!password.value) {
      errors.password = 'Password diperlukan';
      isValid = false;
    } else if (password.value.length < 6) {
      errors.password = 'Password harus minimal 6 karakter';
      isValid = false;
    }

    // Password confirmation
    if (password.value !== passwordConfirm.value) {
      errors.passwordConfirm = 'Password tidak cocok';
      isValid = false;
    }

    // Terms agreement
    if (!agreeToTerms.value) {
      errors.terms = 'Anda harus menyetujui syarat dan ketentuan';
      isValid = false;
    }

    return isValid;
  };

  // Handle registration submission
  const handleRegister = async () => {
    if (!validateForm()) return;

    loading.value = true;

    try {
      // Simulate API call
      await new Promise(resolve => setTimeout(resolve, 1000));

      // Here you would typically make an API call to your registration endpoint
      console.log('Register with:', {
        name: name.value,
        email: email.value,
        password: password.value
      });

      // Redirect to login page or dashboard after successful registration
      // window.location.href = '/login';
    } catch (error) {
      console.error('Registration failed:', error);
    } finally {
      loading.value = false;
    }
  };

  // Navigation
  const goToLogin = () => {
    // If using Vue Router
    // this.$router.push('/login');

    // For demonstration
    window.location.href = '/login';
  };
  </script>