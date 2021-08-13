<template>
  <div class="notif-container">
    <router-link :to="{path:'/profile/'+notif.user_id}">
      <div class="img-name">
        <div class="profile_img"><img :src="[notif.profile_img && notif.profile_img.length>0?'https://localhost/roomaterz/public/storage/images/'+notif.profile_img:require('@/assets/icons/unknown-user-icon.svg')]" alt=""></div>
        <div class="name">
          <p>{{ notif.name }}</p>
        </div>
      </div>
    </router-link>
    <div class="message">
      <p>liked your post 👉 </p>
    </div>
    <router-link  :to="{path:'/profile/'+user_id+'/post/'+notif.post_id}">
      <div class="description">
          <p>{{ notif.description }}</p>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  data(){
    return {
      user_id:localStorage.getItem('id')
    }
  }
  ,
  props:["notif"],
}
</script>
<style lang="scss">
@import "@/assets/scss/_shared_style.scss";
a {
  all: unset;
}
* {
  font-family: $main-font;
}
.notif-container {
  font-size: 20px;
  background-color: $primary-bg-color;
  box-shadow: 0px 0px 15px rgba(39, 38, 38, 0.479);
  border-radius: 10px;
  display: flex;
  align-items: center;
  padding: 20px;
  .img-name {
    display: flex;
    align-items: center;
    .profile_img {
      img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        object-fit: cover;
      }
    }
  }
}

</style>