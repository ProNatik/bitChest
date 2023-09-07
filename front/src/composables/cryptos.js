import { ref } from "vue";
import { boughtCryptoFetchAll, cryptoFetchAll, cryptoFetchOne } from "../services/crypto";

export function useCryptos() {
    const cryptos = ref(null);
    const error = ref(null);
    const loading = ref(false);

  async function FetchData() {
    loading.value = true
    try {
      const response = await cryptoFetchAll()
      cryptos.value = response
    } catch (err) {
      error.value = err.message
    } finally {
      loading.value = false
    }
  }
  FetchData()
  
  return { cryptos, error, loading }
}

export async function useCrypto(id) {
    const crypto = ref(null);
    const error = ref(null);
    const loading = ref(false);
    const labels = ref(null);
    const chartData = ref(null);

  
    loading.value = true
    try {
      const response = await cryptoFetchOne(id)
      crypto.value = response
      const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
      labels.value = crypto.value.map((val) => {
        let laDate = new Date(val.date);
        const dateTimeFormat = new Intl.DateTimeFormat('en-US', options);
        return dateTimeFormat.format(laDate);
    });
      chartData.value = crypto.value.map((val) => val.value);
    } catch (err) {
      error.value = err.message
    } finally {
      loading.value = false
    }

  return { crypto, labels, chartData, error, loading }
}

export function useBoughtCryptos() {
    const boughtCryptos = ref(null);
    const error = ref(null);
    const loading = ref(false);

    async function FetchData() {
        loading.value = true
        try {
        const response = await boughtCryptoFetchAll()
        boughtCryptos.value = response
        } catch (err) {
        error.value = err.message
        } finally {
        loading.value = false
        }
    }
    FetchData();
  
  return { boughtCryptos, error, loading }
}