<script setup>
import { useTitle } from '@vueuse/core';
import { useCrypto } from '@/composables/cryptos';
import { onMounted, reactive, ref } from 'vue';
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)


useTitle('Crypto Details - BitChest')

const props = defineProps({
  crypto_id: Number
})

const data = ref(null);
const options = ref(null);

onMounted(async () => {
    const { crypto, labels, chartData } = await useCrypto(props.crypto_id);

    data.value = {
    labels: labels.value,
    datasets: [
      {
        label: crypto.value[0].name,
        data: chartData.value,
        borderColor: "#90CDF4",
        backgroundColor: "#2C5282",
      },
    ],
  };

  options.value = {
    responsive: true,
    
  };
})   
  

</script>

<template>
  

  <v-sheet maxWidth="800" class="mt-5 mx-auto w-75" rounded="xl">
    <Line v-if="data" :data="data" :options="options" />
  </v-sheet>
  

</template>