<template>
  <div @click="$emit('get_conversation_id', conversation.conversation_id,conversation.user_id)" class="conversation-container">
      <img :src="[conversation.profile_img && conversation.profile_img.length>0?'https://localhost/roomaterz/public/storage/images/'+conversation.profile_img:require('@/assets/icons/unknown-user-icon.svg')]" alt="">
      <div class="name-reply">
        <p class="name">{{ conversation.name }}</p>
        <p class="reply">{{ conversation.reply }}</p>
      </div>
      <div class="created-at">
        <p>{{ conversation.created_at }}</p>
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
  props:["conversation"],
}
</script>

<style lang="scss">
@import "@/assets/scss/_shared_style.scss";
.conversation-container{
  font-family:$main-font;
  border-radius: 20px;
  padding: 15px;
  width: 450px;
  background-color: rgb(214, 209, 204);
  align-items: center;
  margin: 12px 0px;
  display:flex;
  cursor: pointer;
  &:hover {
  background-color: rgb(168, 160, 151);

  }
  img {
    margin-right: 15px;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    object-fit: cover;
  }
  .name-reply {
    justify-self: center;
    .name{
      font-weight:700 ;
      font-size: 20px;
      
    }
    .reply {
      display:inline-block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 21ch;

    }
  }
  .created-at{
    align-self: flex-end;
    margin-left: auto;
  }
}
</style>