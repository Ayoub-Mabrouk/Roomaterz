<template>
  <div v-if="chat.mine==1" class="my-message">
    <div class="created-at">
        <p>{{ chat.created_at }}</p>
    </div>
      <div class="img-reply">
        <p class="reply">{{ chat.reply }}</p>
        <img :src="[chat.profile_img && chat.profile_img.length>0?'https://localhost/roomaterz/public/storage/images/'+chat.profile_img:require('@/assets/icons/unknown-user-icon.svg')]" alt="">
      </div>
  </div>
  <div v-if="chat.mine==0" class="your-message">
      <div class="img-reply">
        <img :src="[chat.profile_img && chat.profile_img.length>0?'https://localhost/roomaterz/public/storage/images/'+chat.profile_img:require('@/assets/icons/unknown-user-icon.svg')]" alt="">
        <p class="reply">{{ chat.reply }}</p>
      </div>
      <div class="created-at">
        <p>{{ chat.created_at }}</p>
    </div>
  </div>
</template>

<script>
export default {
data(){
    return {
    //   user_id:localStorage.getItem('id')
    }
  },
  props:["chat"],
}
</script>

<style lang="scss">
@import "@/assets/scss/_shared_style.scss";
.my-message {
  margin: 20px 0px;
  width: 500px;
  align-items: center;
  display: flex;
  margin-left: auto;
  display: flex;
  .created-at{
    text-align: center;
  }
  .img-reply{
    margin-left: auto;
    justify-content: space-between;
    background-color:rgb(137, 139, 134) ;
    img {
      
    }

  }
}
.your-message {
  margin: 20px 0px;

  width: 500px;
  align-items: center;
  display: flex;
  margin-right: auto;
  display: flex; 
  .img-reply{  
  margin-right: auto;
  background-color:rgb(110, 117, 216) ;

  }
}
.img-reply {
  width: 300px;
  border-radius: 20px;
  padding: 20px;
  display: flex;
  gap: 20px;
  img {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    object-fit: cover;
  }
}

</style>