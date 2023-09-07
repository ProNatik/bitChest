import { ref } from "vue";
import { userSolde, usersFetchAll, usersFetchOne } from "../services/users";


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

export function useUser(id) {
  const user = ref(null);
  const error = ref(null);
  const loading = ref(false);

async function FetchData() {
  loading.value = true
  try {
    const response = await usersFetchOne(id)
    user.value = response
  } catch (err) {
    error.value = err.message
  } finally {
    loading.value = false
  }
}
  FetchData()
  return { user, error, loading }
}

export async function useUserSolde() {
  const solde = ref(null);
  const error = ref(null);
  const loading = ref(false);


  loading.value = true
  try {
    const response = await userSolde()
    solde.value = response;
    
  } catch (err) {
    error.value = err.message
  } finally {
    loading.value = false
    
  }
  return { solde, error, loading }
}