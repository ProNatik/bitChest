<script setup>
import { reactive, ref } from 'vue';
import { useTitle } from '@vueuse/core'
import axios from 'axios'
import { useRouter } from 'vue-router';
import { userStore } from '../store';
import { useUserSolde } from '@/composables/users';

useTitle('Login - BitChest')

const router = useRouter();

const Store = userStore();

const form = reactive({
  username: ref(''),
  password: ref(''),
});

const loading = ref(false);
const error = ref(null);

const rules = {
  required: (value) => value.trim() !== '' || 'Champs obligatoire',
}


async function submit() { 
  if (formState.value) {
    loading.value = true;
    try {
      await axios.post('/login', {
        username: form.username,
        password: form.password,
    })
    .then(res => {
      localStorage.setItem('token', res.data.token);
      Store.role = res.data.role;
      useUserSolde().then(data => {
        Store.solde = data.solde.value[0].solde;
      })
    })
    .catch(err => console.log(err));

    if (Store.role === 'admin'){
        await router.push({ name: 'adminHome' });
    } 
    else if (Store.role === 'client'){
        await router.push({ name: 'clientHome' })
    }
    
    } catch (err) {
      error.value = err.message
    } finally {
      loading.value = false
    }   
  }
}

const formState = ref();
</script>

<template>
    <v-sheet max-width="300" class="mx-auto mt-10">
      <v-form validate-on="blur" @submit.prevent="submit" v-model="formState">
        <v-text-field
          variant="outlined"
          v-model="form.username"
          :rules="[rules.required]"
          label="User name"
        ></v-text-field>
        <v-text-field
          variant="outlined"
          v-model="form.password"
          :rules="[rules.required]"
          label="Password"
          type="password"
        ></v-text-field>
  
        <v-btn
          :loading="loading"
          type="submit"
          block
          class="mt-2"
          text="Login"
        ></v-btn>
      </v-form>
      <v-alert type="error" v-if="error" :text="error" />
    </v-sheet>
  </template>
