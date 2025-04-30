<template>
  <div class="min-h-screen flex flex-col">
    <NavbarComponents/>
    <!-- Hero Section -->
    <main class="flex-grow">
      <section
        class="py-16 md:py-24 lg:py-32 bg-gradient-to-b from-white to-gray-50"
      >
        <div class="container mx-auto px-4">
          <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
              <h1
                class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4"
              >
                Selamat Datang di Platform Kami
              </h1>
              <p class="text-lg text-gray-600 mb-8">
                Temukan pengalaman terbaik dengan layanan kami yang inovatif dan
                mudah digunakan.
              </p>
              <div class="flex flex-col sm:flex-row gap-4">
                <button
                  @click="navigateToLogin"
                  class="px-6 py-3 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition-colors text-lg font-medium"
                >
                  Masuk Sekarang
                </button>
                <button
                  class="px-6 py-3 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors text-lg font-medium"
                >
                  Pelajari Lebih Lanjut
                </button>
              </div>
            </div>
            <div class="md:w-1/2">
              <img
                src="https://via.placeholder.com/600x400"
                alt="Welcome illustration"
                class="rounded-lg shadow-lg w-full"
              />
            </div>
          </div>
        </div>
      </section>

      <!-- Features Section -->
      <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
          <h2 class="text-3xl font-bold text-center mb-12">
            Fitur Unggulan Kami
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
              class="p-6 border rounded-lg hover:shadow-md transition-shadow"
            >
              <zap-icon class="h-10 w-10 text-indigo-600 mb-4" />
              <h3 class="text-xl font-semibold mb-2">Cepat & Efisien</h3>
              <p class="text-gray-600">
                Layanan kami dirancang untuk memberikan hasil yang cepat dan
                efisien.
              </p>
            </div>
            <div
              class="p-6 border rounded-lg hover:shadow-md transition-shadow"
            >
              <shield-icon class="h-10 w-10 text-indigo-600 mb-4" />
              <h3 class="text-xl font-semibold mb-2">Aman & Terpercaya</h3>
              <p class="text-gray-600">
                Keamanan data Anda adalah prioritas utama kami.
              </p>
            </div>
            <div
              class="p-6 border rounded-lg hover:shadow-md transition-shadow"
            >
              <users-icon class="h-10 w-10 text-indigo-600 mb-4" />
              <h3 class="text-xl font-semibold mb-2">Dukungan Pengguna</h3>
              <p class="text-gray-600">
                Tim dukungan kami siap membantu Anda 24/7.
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
    <FooterComponents/>
  </div>
</template>
<script setup>
import { ZapIcon, ShieldIcon, UsersIcon } from "lucide-vue-next";

import FooterComponents from "./section/FooterComponents.vue";
import NavbarComponents from "./navigation/NavbarComponents.vue";

</script>
