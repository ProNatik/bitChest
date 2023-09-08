<script setup>
import { useTitle } from '@vueuse/core';
import { useBoughtCryptos } from '@/composables/cryptos';
import { sellCrypto } from '@/services/crypto';
import { ref } from 'vue';
import router from '@/router';
import { userStore } from '@/store';


useTitle('Profil - BitChest')

const Store = userStore();

const errorMessage = ref(null);
const success = ref(null);
const { boughtCryptos, error, loading } = useBoughtCryptos();


function showCrypto(crypto) {
    router.push({ name: 'clientCryptoDetails', params: { crypto_id: crypto.id } })
}

async function sellCryptoBtn(crypto) {
    try {
        await sellCrypto(crypto).then(data => {
            Store.solde = data.newSolde[0].solde;
            success.value = data.addToSolde +'$ gagné' 
        });
        boughtCryptos.value = boughtCryptos.value.filter((bC) => bC !== crypto)
    } catch (error) {
        errorMessage.value = error.message
    }
}

</script>

<template>
  
  <v-sheet maxWidth="800" class="mt-5 mx-auto w-75" rounded="xl">
    <v-table v-if="boughtCryptos">
    <thead>
      <tr>
        <th class="text-center">
          Name
        </th>
        <th class="text-center">
          Quantity
        </th>
        <th class="text-center">
          Sell
        </th>
        <th class="text-center">
          Details
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="boughtCrypto in boughtCryptos"
        :key="boughtCrypto.id"
        class="text-center"
      >
        <td>{{ boughtCrypto.name }}</td>
        <td>{{ boughtCrypto.quantity }} </td>
        <td>
            <v-btn
            @click="sellCryptoBtn(boughtCrypto)"
            variant="outlined"
            size="small"
            color="red"
            >Sell</v-btn>
        </td>
        <td>
            <v-btn
            @click="showCrypto(boughtCrypto)"
            variant="outlined"
            size="small"
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
    <v-alert type="success" v-if="success" :text="success" />
    <v-alert type="error" v-if="errorMessage" :text="errorMessage" />
  </v-sheet>
  

</template>