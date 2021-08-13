// import { hasOwnMetadata } from 'core-js/fn/reflect'
import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/login.vue'
import Register from '../views/register.vue'
import Home from '../views/home.vue'
import Add from '../views/add.vue'
import Profile from '../views/profile.vue'
import Single_Post from '../views/Single_Post.vue'
import Search from '../views/search.vue'
import Search_result from '../views/search_result.vue'
import My_interests from '../views/my_interests.vue'
import Notifications from '../views/notifications.vue'
import Messages from '../views/messages.vue'

const isAuthenticated = async () => {
  if (localStorage.getItem("token")) {
    const response = await fetch("https://localhost/roomaterz/user/check_expiration", {
      method: "POST",
      headers: {
        "accept": "application/json",
        "Authorization": `Bearer ${localStorage.getItem("token")}`
      },
    });
    const data = await response.json();
    return data;
  }
  else {
    return false;
  }
}
const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  },
  {
    path: '/add',
    name: 'Add',
    component: Add,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  }
  ,
  {
    path: '/profile/:id',
    name: 'Profile',
    component: Profile,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    },
  },
  {
    path: '/profile/:user_id/post/:post_id',
    name: 'Single_Post',
    component: Single_Post,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  },
  {
    path: '/search/:type_id/:city_id',
    name: 'Search_result',
    component: Search_result,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  },
  {
    path: '/search',
    name: 'Search',
    component: Search,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  },
  {
    path: '/my_interests',
    name: 'My_interests',
    component: My_interests,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  },
  {
    path: '/notifications',
    name: 'Notifications',
    component: Notifications,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  },
  {
    path: '/messages',
    name: 'Messages',
    component: Messages,
    async beforeEnter(to, from, next){
      if ( await isAuthenticated()==false) {
        console.log('logged out');
        next({ name: 'Login' });
      }
      else {
        next();
      }
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
export default router
