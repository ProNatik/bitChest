<script setup>
import { ref } from 'vue';
import router from '../router';
import axiosClient from "@/axios";

const title = computed(() => {
  return router.currentRoute.value.meta.title;
});

async function logout() { 
    try {
      await axiosClient.post('/logout')
    .then(res => {
      localStorage.removeItem('token');
    })
    .catch(err => console.log(err));

    await router.push({ name: 'login' });
    } catch (err) {
      console.log(err.message);
    }
}

</script>

<template>
    <v-layout class="rounded rounded-md">
      <v-navigation-drawer>
        <div class="d-flex justify-center align-center">
            <img src="@/assets/bitchest_logo.png" alt="logo" style="height: 55px;">
        </div>
        <div class="d-flex justify-center align-center">
            <v-btn @click="logout" color="red-darken-3" rounded="ls">Logout</v-btn>
        </div>
        
        <v-list>
          <v-list-item title="Navigation drawer"></v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-app-bar :title=title></v-app-bar>
  
      <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
        <router-view></router-view>
      </v-main>
    </v-layout>
  </template>