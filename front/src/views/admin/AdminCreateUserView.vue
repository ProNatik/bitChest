<script setup>

import { reactive, ref } from 'vue';
import { userCreate } from '@/services/users';
import { useTitle } from '@vueuse/core';

useTitle('Create User - BitChest')

const form = reactive({
  username: ref(''),
  password: ref(''),
  role: ref('')
});

const rules = {
  required: (value) => value.trim() !== '' || 'Champs obligatoire',
}

const error = ref(null);
const loading = ref(false);
const success = ref(null);

async function addUser() { 
  if (formState.value) {
    loading.value = true;
    try {
      await userCreate(form.username, form.password, form.role)
      .catch(err => console.log(err));

      success.value = 'Added user' 
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
  <div class="h-screen w-100 mt-12">
    <v-sheet max-width="800" min-width="200" class="mx-auto mt-10 mb-2 elevation-2 rounded-lg" style="padding: 10px;" color="grey-lighten-3">
        <v-form validate-on="blur" @submit.prevent="addUser" v-model="formState" >
            <v-row>
                <v-col
                cols="12"
                md="4"
                >
                    <v-text-field
                    v-model="form.username"
                    :rules="[rules.required]"
                    label="username"
                    ></v-text-field>
                </v-col>
                <v-col
                cols="12"
                md="4"
                >
                    <v-text-field
                    v-model="form.password"
                    :rules="[rules.required]"
                    type="password"
                    label="password"
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    md="4"
                >
                    <v-select
                    v-model="form.role"
                    :rules="[rules.required]"
                    :items="['admin', 'client']"
                    label="role"
                    ></v-select>
                </v-col>
            </v-row>
            
            <div class="text-center">
                <v-btn :loading="loading" type="submit" class="mt-2" text="Add" maxWidth="40px"></v-btn>
            </div>
            
        </v-form>
    </v-sheet>
    <v-alert class="mx-auto w-25" color="error" v-if="error" :text="error" />
    <v-alert class="mx-auto w-25" color="success" v-if="success" :text="success" />
  </div>
    
</template>