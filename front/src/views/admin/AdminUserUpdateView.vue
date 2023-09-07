<script setup>
import { useTitle } from '@vueuse/core';
import { ref } from 'vue';
import { useUser } from '@/composables/users';
import { userUpdate } from '@/services/users';

useTitle('Update User - BitChest')

const props = defineProps({
  user_id: Number
})

const { user } = useUser(props.user_id);


const loading = ref(false);
const error = ref(null);
const success = ref(null);

async function update() { 
  if (formState.value) {
    loading.value = true;
    try {
      await userUpdate(props.user_id, user.value.username, user.value.role);

      success.value = 'Updated user' 
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
    <v-sheet width="600" class="mx-auto">
        <v-form validate-on="blur" @submit.prevent="update" v-model="formState">
            <v-row>
                <v-col
                cols="12"
                md="6"
                >
                    <v-text-field v-if="user"
                        variant="outlined"
                        v-model="user.username"                      
                        label="Username"
                    ></v-text-field>
                </v-col>
                <v-col
                cols="12"
                md="6"
                >
                    <v-select v-if="user"
                    v-model="user.role"
                    :items="['client', 'admin']"
                    label="Role"
                    item-title="role"
                    item-value="role"
                    required
                    ></v-select>
                </v-col>
            </v-row>
            <v-btn
            :loading="loading"
            type="submit"
            block
            class="mt-2"
            text="Update"
            ></v-btn>
        </v-form>
        <v-alert type="error" v-if="error" :text="error" />
        <v-alert type="success" v-if="success" :text="success" />
    </v-sheet>
</template>