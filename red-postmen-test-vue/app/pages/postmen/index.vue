<script setup lang="ts">
import { getAllAreas } from "~/services/area.service";

const {
  data: areas,
  pending,
  error,
} = await useAsyncData("areas", () => getAllAreas());
</script>

<template>
  <h1 class="text-secondary">Hello postmen page</h1>
  <div v-if="pending">Loading...</div>
  <div v-else-if="error">Error loading areas</div>
  <div v-else>Welcome, {{ areas }}</div>
</template>
