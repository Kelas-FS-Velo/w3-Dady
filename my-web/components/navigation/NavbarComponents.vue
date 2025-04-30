<template>
  <!-- Navigation -->
  <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center">
        <home-icon class="h-6 w-6 text-indigo-600" />
        <span class="ml-2 text-xl font-bold text-indigo-600">Brand</span>
      </div>
      <div v-if="user" class="relative px-5 py-1.5 border rounded-[10px]">
        <button
          @click="toggleDropdown"
          class="flex items-center gap-4 focus:outline-none"
        >
          <span class="text-lg font-semibold text-blue-950">{{
            user.username
          }}</span>
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
                <Icon icon="mdi:account" width="24" height="24" />
              </i>

              <p class="capitalize">profile</p>
            </li>
            <li
              class="px-4 py-2 hover:bg-blue-500 hover:text-white cursor-pointer flex items-center gap-3 text-black rounded transition-all duration-300"
              @click="handleOnClick('/profile/transactions')"
            >
              <i>
                <Icon
                  icon="icon-park-outline:transaction"
                  width="24"
                  height="24"
                />
              </i>

              <p class="capitalize">Transactions</p>
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
</template>

<script setup>
import { HomeIcon } from "lucide-vue-next";

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
