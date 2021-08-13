<template>
  <div class="notifs-container">
    <div  class="notifications">
      <Notif v-for="notif in notifs"  :key="notif.post_id" :notif="notif" />
    </div> 
  </div>
</template>
<script>

import Notif from '../components/notif.vue'
import jscript from "@/assets/javascript/fetch.js";
export default {
  components: { Notif },
  data(){
    return {
      notifs:[],
    }
  },
  methods:{
    async notifications(){
      let token=localStorage.getItem('token')
      if(token){
        this.notifs = await jscript.post('https://localhost/roomaterz/interest/notification','',token); 
        console.table(this.notifs)
      }
      else {
        this.notifs=false;
      }
    }
  },
  beforeMount(){
    this.notifications()
  }
}
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";
.notifs-container {
    width: 100%;
  .notifications {
    .notif-container {
      margin: 25px 0;
    }
    @include iphone6_7_8 {
      
    }
    
  }
}
</style>