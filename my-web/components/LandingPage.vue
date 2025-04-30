<template>
  <div class="min-h-screen flex flex-col">
    <!-- Navigation -->
    <header class="bg-white shadow-sm">
      <div
        class="container mx-auto px-4 py-4 flex justify-between items-center"
      >
        <div class="flex items-center">
          <home-icon class="h-6 w-6 text-indigo-600" />
          <span class="ml-2 text-xl font-bold text-indigo-600">Brand</span>
        </div>
        <div v-if="user" class="relative px-5 py-1.5 border rounded-[10px]">
          <button
            @click="toggleDropdown"
            class="flex items-center gap-4 focus:outline-none"
          >
            <span class="text-lg font-semibold text-blue-950">{{ user.username }}</span>
          </button>

          <div
            v-if="isDropdownOpen"
            class="absolute right-0 mt-3 w-32 bg-white shadow-lg rounded-lg"
          >
            <ul class="text-sm text-gray-700">
              <li
                class="px-4 py-2 hover:bg-blue-500 hover:text-white cursor-pointer flex items-center gap-3 text-black rounded transition-all duration-300"
                @click="handleOnClick('/profile')"
              >
                <i>
                  <Icon icon="iconamoon:profile-thin" width="24" height="24" />
                </i>

                <p class="capitalize">profile</p>
              </li>
              <li
                class="px-4 py-2 hover:bg-blue-500 hover:text-white cursor-pointer flex items-center gap-3 text-black rounded transition-all duration-300"
                @click="handleOnClick('/profile/transaksi')"
              >
                <i>
                  <Icon
                    icon="icon-park-outline:transaction"
                    width="24"
                    height="24"
                  />
                </i>

                <p class="capitalize">Transaksi</p>
              </li>
              <li
                class="px-4 py-2 hover:bg-red-600 hover:text-white cursor-pointer flex items-center gap-3 text-black rounded transition-all duration-300"
                @click="handleLogout"
              >
                <i>
                  <Icon
                    icon="material-symbols-light:logout"
                    width="24"
                    height="24"
                  />
                </i>

                <p>Logout</p>
              </li>
            </ul>
          </div>
        </div>
        <button
          v-else
          @click="navigateToLogin"
          class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition-colors"
        >
          Login
        </button>
      </div>
    </header>

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

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <div class="mb-4 md:mb-0">
            <p>
              &copy; {{ new Date().getFullYear() }} Brand. All rights reserved.
            </p>
          </div>
          <div class="flex space-x-4">
            <a href="#" class="hover:text-indigo-400 transition-colors"
              >Tentang Kami</a
            >
            <a href="#" class="hover:text-indigo-400 transition-colors"
              >Kontak</a
            >
            <a href="#" class="hover:text-indigo-400 transition-colors"
              >Kebijakan Privasi</a
            >
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
<script setup>
import { HomeIcon, ZapIcon, ShieldIcon, UsersIcon } from "lucide-vue-next";
import { useRouter } from "vue-router";
import { ref, onMounted } from "vue";

const router = useRouter();
const user = ref(null);

const checkUser = () => {
  const role = localStorage.getItem("role");
  const username = localStorage.getItem("username");
  const token = localStorage.getItem("token");
  if (role === "user" && token && username) {
    user.value = { username };
  } else {
    user.value = null;
  }
};

onMounted(() => {
  checkUser();
});

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

const isDropdownOpen = ref(false);

const handleOnClick = (path) => {
  router.push(path);
};

const handleLogout = () => {
  localStorage.clear();
  user.value = null;
  router.push("/login");
};

const navigateToLogin = () => {
  router.push("/login");
};
</script>
