<template>
  <Navigation v-if="!(['Login', 'Register'].includes($route.name))"/>
  <router-view :key="$route.fullPath" />
  <!-- <Profile/> -->
  <!-- <Register/> -->
</template>
<script>
// import Modal from "./components/Modal.vue";
import Login from "./views/login.vue";
import Register from "./views/register.vue";
import Profile from "./views/profile.vue";
import Navigation from "./components/Navigation.vue";


export default {
  components: {
    Login,Register,Profile,Navigation
  },
  data() {
    return {
      title: "ayoub",
      linktitle: "http://google.com",
    };
  },
};
</script>

<style lang="scss">
@import '@/assets/scss/_shared_style.scss';

// #app {
  
//   font-family: Avenir, Helvetica, Arial, sans-serif;
//   -webkit-font-smoothing: antialiased;
//   -moz-osx-font-smoothing: grayscale;
//   text-align: center;
//   color: #2c3e50;
// }

// #nav {
//   padding: 30px;

//   a {
//     font-weight: bold;
//     color: #2c3e50;

//     &.router-link-exact-active {
//       color: #42b983;
//     }
//   }
// }
</style>
