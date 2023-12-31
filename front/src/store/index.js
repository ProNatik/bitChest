import { defineStore } from 'pinia'
import { ref } from 'vue'

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const userStore = defineStore('user', () => {
    const role = ref(null);
    const solde = ref(null);

    return { role, solde }
});

export function clearUserStore() {
    const Store = userStore();
    Store.role = null;
    Store.solde = null;
};
  
  
  
  
  
  