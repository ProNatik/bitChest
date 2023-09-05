<script setup>
import { useTitle } from '@vueuse/core';
import { useCryptos } from '@/composables/cryptos';
import { ref } from 'vue';
import router from '@/router';


useTitle('Admin Home - BitChest')

const errorMessage = ref(null);
const success = ref(null);

const { cryptos, error, loading } = useCryptos();

function showCrypto(crypto) {
    router.push({ name: 'adminCryptoDetails', params: { crypto_id: crypto.id } })
}

</script>

<template>
  
  
  <v-alert type="error" v-if="errorMessage" :text="errorMessage" />
  <v-sheet maxWidth="800" class="mt-5 mx-auto w-75" rounded="xl">
    <v-table v-if="cryptos">
    <thead>
      <tr>
        <th class="text-center">
          Name
        </th>
        <th class="text-center">
          Value
        </th>
        <th class="text-center">
          Last change
        </th>
        <th class="text-center">
          Details
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="crypto in cryptos"
        :key="crypto.id"
        class="text-center"
      >
        <td>{{ crypto.name }}</td>
        <td>{{ crypto.crypto_values[0].value }} </td>
        <td>{{ crypto.crypto_values[0].date }} </td>
        <td>
            <v-btn
            @click="showCrypto(crypto)"
            variant="outlined"
            size="x-small"
            color="blue"
            >Details</v-btn>
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