<script setup lang="ts">
import type { FormSubmitEvent } from "@nuxt/ui";
import { login } from "~/services/login.service";

const state = reactive({
  email: "",
  password: "",
});

const toast = useToast();
async function onLogin(event: FormSubmitEvent<typeof state>) {
  const response = await login(event.data.email, event.data.password);

  toast.add({
    title: "Success",
    description: "The form has been submitted.",
    color: "success",
  });
  console.log(event.data, response);
}
</script>

<template>
  <h1 class="text-secondary">Login to the app</h1>
  <UForm :state="state" class="space-y-4" @submit="onLogin">
    <UFormField label="Email" name="email">
      <UInput v-model="state.email" />
    </UFormField>

    <UFormField label="Password" name="password">
      <UInput v-model="state.password" type="password" />
    </UFormField>

    <UButton type="submit">Submit</UButton>
  </UForm>
</template>
