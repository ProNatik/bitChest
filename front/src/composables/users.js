import { ref } from "vue";
import { usersFetchAll } from "../services/users";


export function useUsers() {
    const users = ref(null);
    const error = ref(null);
    const loading = ref(false);

  async function FetchData() {
    loading.value = true
    try {
      const response = await usersFetchAll()
      users.value = response
    } catch (err) {
      error.value = err.message
    } finally {
      loading.value = false
    }
  }

  FetchData()

  return { users, error, loading }
}