import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '@/views/LoginView.vue'
import AdminLayout from '@/components/AdminLayout.vue'
import AdminHomeView from '@/views/admin/AdminHomeView.vue'
import AdminUserListView from '@/views/admin/AdminUserListView.vue'
import AdminCreateUserView from '@/views/admin/AdminCreateUserView.vue'
import AdminUserUpdateView from '@/views/admin/AdminUserUpdateView.vue'
import AdminCryptoDetailsView from '@/views/admin/AdminCryptoDetailsView.vue'
import ClientLayout from '@/components/ClientLayout.vue'
import ClientHomeView from '@/views/client/ClientHomeView.vue'
import ClientCryptoDetailsView from '@/views/client/ClientCryptoDetailsView.vue'
import ClientBuyCryptoView from '@/views/client/ClientBuyCryptoView.vue'
import { userStore } from '@/store'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
      {
        path: '/',
        name: 'login',
        component: LoginView
      },
      {
        path: '/admin',
        component: AdminLayout,
        children: [
            {
                path: 'adminHome',
                name: 'adminHome',
                component: AdminHomeView,
                meta: { title: 'Admin Home', admin: true }
            },
            {
                path: 'adminUserList',
                name: 'adminUserList',
                component: AdminUserListView,
                meta: { title: 'Admin User List', admin: true }
            },
            {
                path: 'adminCreateUser',
                name: 'adminCreateUser',
                component: AdminCreateUserView,
                meta: { title: 'Admin Create User', admin: true }
            },
            {
                path: 'adminUserUpdate/:user_id',
                name: 'adminUserUpdate',
                component: AdminUserUpdateView,
                props: true,
                meta: { title: 'Admin Update User', admin: true }
            },
            {
                path: 'adminCryptoDetails/:crypto_id',
                name: 'adminCryptoDetails',
                component: AdminCryptoDetailsView,
                props: true,
                meta: { title: 'Admin CryptoDetails', admin: true }
            }
        ]
      },
      {
        path: '/',
        component: ClientLayout,
        children: [
            {
                path: 'clientHome',
                name: 'clientHome',
                component: ClientHomeView,
                meta: { title: 'Home', client: true }
            },
            {
                path: 'clientCryptoDetails/:crypto_id',
                name: 'clientCryptoDetails',
                component: ClientCryptoDetailsView,
                props: true,
                meta: { title: 'CryptoDetails', client: true }
            },
            {
                path: 'clientBuyCrypto/:crypto_id',
                name: 'clientBuyCrypto',
                component: ClientBuyCryptoView,
                props: true,
                meta: { title: 'BuyCrypto', client: true }
            },
            {
                path: 'clientProfil',
                name: 'clientProfil',
                component: ClientProfilView,
                props: true,
                meta: { title: 'Profil', client: true }
            },
        ]
      }
    ]
});

router.beforeEach((to, from, next) => {

    const Store = userStore();

    if (to.meta.admin && Store.role !== 'admin') {
        localStorage.removeItem('token');
        next({name: 'login'});
    } else {
        next();
    }

    if (to.meta.client && Store.role !== 'client') {
        localStorage.removeItem('token');
        next({name: 'login'});
    } else {
        next();
    }
});

export default router