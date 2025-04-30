<template>
  <div
    class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
  >
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
        <form class="space-y-6" @submit="handleRegister">
          <div>
            <label
              for="fullname"
              class="block text-sm font-medium text-gray-700"
            >
              Nama Lengkap
            </label>
            <div class="mt-1">
              <input
                id="fullname"
                v-model="fullname"
                type="text"
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Nama Lengkap"
              >
            </div>
            <span v-if="fullnameError" class="text-red-500 text-xs">{{
              fullnameError
            }}</span>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email
            </label>
            <div class="mt-1">
              <input
                id="email"
                v-model="email"
                type="email"
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="nama@example.com"
              >
            </div>
            <span v-if="emailError" class="text-red-500 text-xs">{{
              emailError
            }}</span>
          </div>

          <div>
            <label
              for="password"
              class="block text-sm font-medium text-gray-700"
            >
              Password
            </label>
            <div class="mt-1 relative">
              <input
              v-model="password"
                :type="showPassword ? 'text' : 'password'"
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="••••••••"
>
              <button
                type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-500"
                @click="togglePassword"
              >
                <eye-icon v-if="!showPassword" class="h-5 w-5" />
                <eye-off-icon v-else class="h-5 w-5" />
              </button>
            </div>
            <span v-if="passwordError" class="text-red-500 text-xs">{{
              passwordError
            }}</span>
          </div>

          <div>
            <label
              for="confirmation_password"
              class="block text-sm font-medium text-gray-700"
            >
              Konfirmasi Password
            </label>
            <div class="mt-1 relative">
              <input
                v-model="confirmation_password"
                :type="showRePassword ? 'text' : 'password'"
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="••••••••"
              >
              <button
                type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-500"
                @click="toggleRePassword"
              >
                <eye-icon v-if="!showRePassword" class="h-5 w-5" />
                <eye-off-icon v-else class="h-5 w-5" />
              </button>
            </div>
            <span v-if="confirmationPasswordError" class="text-red-500 text-xs">{{
              confirmationPasswordError
            }}</span>
          </div>

          <div>
            <label
              for="address"
              class="block text-sm font-medium text-gray-700"
            >
              Alamat
            </label>
            <div class="mt-1">
              <textarea
                id="address"
                v-model="address"
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Alamat Lengkap"
              ></textarea>
            </div>
            <span v-if="addressError" class="text-red-500 text-xs">{{
              addressError
            }}</span>
          </div>

          <div>
            <label for="bod" class="block text-sm font-medium text-gray-700">
              Tanggal Lahir
            </label>
            <div class="mt-1">
              <input
                id="bod"
                v-model="bod"
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                type="date"
              >
            </div>
            <span v-if="bodError" class="text-red-500 text-xs">{{
              bodError
            }}</span>
          </div>

          <div>
            <button
              type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              <loader-icon
                v-if="loading"
                class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
              />
              Daftar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { EyeIcon, EyeOffIcon, LoaderIcon } from "lucide-vue-next";
import { useRouter } from "vue-router";
import { useForm, useField } from "vee-validate";
import * as Yup from "yup";
import { AuthAPI } from "~/server/apis/Auth";

const router = useRouter();
const showPassword = ref(false);
const showRePassword = ref(false);
const loading = ref(false);

// Toggle password visibility
const togglePassword = () => {
  showPassword.value = !showPassword.value;
};

const toggleRePassword = () => {
  showRePassword.value = !showRePassword.value;
};

// Validation schema
const validationSchema = Yup.object({
  fullname: Yup.string()
    .min(2, "Nama harus minimal 2 karakter")
    .required("Nama diperlukan"),
  email: Yup.string()
    .email("Format email tidak valid")
    .required("Email diperlukan"),
  password: Yup.string()
    .min(6, "Password harus minimal 6 karakter")
    .required("Password diperlukan"),
  confirmation_password: Yup.string()
    .oneOf([Yup.ref("password")], "Konfirmasi password tidak cocok")
    .required("Konfirmasi password diperlukan"),
  address: Yup.string().required("Alamat diperlukan"),
  bod: Yup.date().required("Tanggal lahir diperlukan"),
});

const { handleSubmit } = useForm({ validationSchema });
const { value: fullname, errorMessage: fullnameError } = useField("fullname");
const { value: email, errorMessage: emailError } = useField("email");
const { value: password, errorMessage: passwordError } = useField("password");
const { value: confirmation_password, errorMessage: confirmationPasswordError } =
  useField("confirmation_password");
const { value: address, errorMessage: addressError } = useField("address");
const { value: bod, errorMessage: bodError } = useField("bod");

// Handle registration
const handleRegister = handleSubmit(async (values) => {
  loading.value = true;

  try {
    const payload = {
      fullname: values.fullname,
      email: values.email,
      password: values.password,
      address: values.address,
      bod: values.bod,
      role: "user",
    };

    const response = await AuthAPI.register(payload);

    if (response.status === "success") {
      router.push("/login");
      return;
    } else {
      console.log(
        Object.keys(response.errors).map((key) => response.errors[key])
      );
      alert("Registration failed. Please try again.");
    }
    return response;
  } catch (error) {
    console.error("Registration failed:", error);
  } finally {
    loading.value = false;
  }
});

// Navigate to login page
const goToLogin = () => {
  router.push("/login");
};
</script>
