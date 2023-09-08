<script setup>
import { useTitle } from '@vueuse/core';
import { reactive, ref } from 'vue';
import { userStore } from '@/store';
import { useCrypto } from '@/composables/cryptos';
import { buyCrypto } from '@/services/crypto'


useTitle('Buy Crypto - BitChest');

const Store = userStore();

const props = defineProps({
  crypto_id: Number
})

const loading = ref(false);
const error = ref(null);
const success = ref(null);

const rules = {
  required: (value) => value.trim() !== '' || 'Champs obligatoire',
}

const crypto = ref(null);

useCrypto(props.crypto_id).then(data => {
    crypto.value = data.crypto.value;
})

const form = reactive({
  quantity: ref(''),
});

async function buy() { 
  if (formState.value) {
    loading.value = true;
    try {
      await buyCrypto(props.crypto_id, form.quantity, crypto.value[29].value, Store.solde)
    .then(res => {
      Store.solde = res.data.newSolde;
      success.value = res.data.message;
    })
    .catch(err => console.log(err));
    
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
    <div>
        
        <v-sheet max-width="500" min-width="100" class="mx-auto mt-10" v-if="crypto" style="margin-bottom: 10px;">
            
            
            <div  style="margin-bottom: 5px; text-align: center;">
                {{ crypto[0].name }}
            </div>
        <v-form validate-on="blur" @submit.prevent="buy" v-model="formState" class="mx-auto">
            <v-text-field
            variant="outlined"
            v-model="crypto[29].value"
            label="Price"
            readonly
            class="mt-2"
            ></v-text-field>
            <v-text-field
            variant="outlined"
            v-model="form.quantity"
            :rules="[rules.required]"
            label="Quantity"
            type="text"
            class="mt-2"
            ></v-text-field>
    
            <v-btn
            :loading="loading"
            type="submit"
            block
            class="mt-2"
            text="Buy"
            ></v-btn>
        </v-form>
        
        </v-sheet>
        <v-alert type="success" v-if="success" :text="success" />
        <v-alert type="error" v-if="error" :text="error" />
    </div>
    
  </template>