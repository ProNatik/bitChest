import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '@/views/LoginView.vue'
import AdminLayout from '@/components/AdminLayout.vue'
import AdminHomeView from '@/views/admin/AdminHomeView.vue'
import AdminUserListView from '@/views/admin/AdminUserListView.vue'
import ClientLayout from '@/components/ClientLayout.vue'
import ClientHomeView from '@/views/client/ClientHomeView.vue'
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
                meta: { title: 'Admin UserList', admin: true }
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
                meta: { title: 'Client Home' }
            }
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
  });

export default router