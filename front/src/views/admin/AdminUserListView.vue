<script setup>
import { useUsers } from '@/composables/users';
import { ref } from 'vue';
import { userRemove } from '@/services/users';


const errorMessage = ref(null);
const success = ref(null);

const { users, error, loading } = useUsers();

async function deleteUser(user) {
  errorMessage.value = null
  try {
    await userRemove(user)
    users.value = users.value.filter((p) => p !== user)
  } catch (error) {
    errorMessage.value = error.message
  }
}

function updateUser(user) {
    router.push({ name: 'updatePaire', params: { from_devise: paire.from_devise, to_devise: paire.to_devise, value: paire.value } })
}

</script>

<template>
  
  
  <v-alert type="error" v-if="errorMessage" :text="errorMessage" />
  <v-sheet maxWidth="800" class="mt-5 mx-auto w-75" rounded="xl">
    <v-table v-if="users">
    <thead>
      <tr>
        <th class="text-center">
          Username
        </th>
        <th class="text-center">
          Role
        </th>
        <th class="text-center">
          Update
        </th>
        <th class="text-center">
          Delete
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="user in users"
        :key="user.created_at"
        class="text-center"
      >
        <td>{{ user.username }}</td>
        <td>{{ user.role }} </td>
        <td>
            <v-btn
            @click="updateUser(user)"
            variant="outlined"
            size="x-small"
            color="teal"
            >Update</v-btn>
        </td>
        <td>
            <v-btn
            @click="deleteUser(user)"
            variant="outlined"
            size="x-small"
            color="red"
            >Delete</v-btn>
        </td>
      </tr>
    </tbody>
  </v-table>
  <v-skeleton-loader
      type="table"
      v-else-if="loading"
      :style="{ maxWidth: '40rem' }"
      class="ma-auto"
    />
  </v-sheet>

</template>