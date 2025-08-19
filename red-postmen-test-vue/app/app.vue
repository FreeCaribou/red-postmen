<script setup lang="ts">
import type { NavigationMenuItem } from "@nuxt/ui";

const title = ref("Red postmen");

const items = ref<NavigationMenuItem[]>([
  {
    label: "Home",
    icon: "material-symbols:home-outline",
    to: "/",
  },
  {
    label: "Login",
    icon: "material-symbols:supervised-user-circle",
    to: "/login",
  },
  {
    label: "Postmen",
    icon: "material-symbols:local-post-office",
    to: "/postmen",
  },
]);
</script>

<template>
  <Head>
    <Title>{{ title }}</Title>
    <Meta name="description" :content="title" />
  </Head>
  <header>
    <UNavigationMenu :items="items" class="w-full justify-center" />
  </header>
  <UApp>
    <div class="p-2">
      <NuxtPage />
    </div>
  </UApp>
</template>
