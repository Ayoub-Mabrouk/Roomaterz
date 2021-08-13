<template>
  <div class="post-container">
    <div class="img-name-date">
      <div class="profile-img">
        <router-link :to="{path:'/profile/'+post.user_id}"><img :src="[post.profile_img && post.profile_img.length>0?'https://localhost/roomaterz/public/storage/images/'+post.profile_img:require('@/assets/icons/unknown-user-icon.svg')]" alt=""></router-link>
      </div>
      <div class="name-date-city">
        <div class="name">
          <p><router-link :to="{path:'/profile/'+post.user_id}">{{ post.name }}</router-link></p>
        </div>
        <div class="date">
          <p>{{ post.created_at }}</p>
        </div> 
        <div class="city">
          <p>{{ post.city }}</p>
        </div>
      </div>
    <div v-if="(user_id==post.user_id)" class="delete-icon">
      <img @click="delete_post($event,post.post_id)" src="@/assets/icons/trash-icon.svg" alt="">
    </div>

    </div>
    <router-link  :to="{path:'/profile/'+post.user_id+'/post/'+post.post_id}">
      <div class="description">
        <div class="type">
          <p>{{ post.type }}</p>
        </div>
        <p>{{ post.description }}</p>
    </div>
    </router-link>  
    
    <div class="engagement">
      <div class="like-icon">
        <img @mouseover="check" @click="like(post.post_id,$event)" :class="[post.liked==1?'liked':'not_liked']" src="@/assets/icons/like-icon.svg" alt="">
      </div>
      <div class="likes">
        <p > {{ post.likes }} </p>
      </div>
    </div>
  </div>
    
</template>

<script>
import jscript from "@/assets/javascript/fetch.js";

export default {
  data(){
    return {
      user_id:localStorage.getItem('id')
    }
  },
  props:["post"],
  methods:{
    async delete_post(e,post_id){
      let token=localStorage.getItem('token');
      if(token){
          await jscript.post('https://localhost/roomaterz/post/delete_post',{post_id:post_id},token);        
          e.target.parentElement.parentElement.parentElement.style.display="none";
      }
    },
    async like(post_id,e){
      if(!(localStorage.getItem('id')==this.$props.post.user_id)){
        let token=localStorage.getItem('token');
      if(token){
        if(e.target.className=='liked'){
          e.target.setAttribute("class", "not_liked");
          this.$props.post.likes--;
          await jscript.post('https://localhost/roomaterz/interest/disinterested',{post_id:post_id},token);

        }else {
          e.target.setAttribute("class", "liked");
          this.$props.post.likes++;
          await jscript.post('https://localhost/roomaterz/Interest/interested',{post_id:post_id},token);
        }
      }
      }else { 
        console.log("liking ur own post is like high fiving urself in public")
      }
    
    },

    check(e){
      if(localStorage.getItem('id')==this.$props.post.user_id){
        e.target.style.cursor = "not-allowed";
      }
      
    }
  }
}
</script>
<style lang="scss">
@import "@/assets/scss/_shared_style.scss";

.post-container {
  cursor:pointer;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.158);
  background-color:#F9F9F9;
  border-radius: 5px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  gap: 0.4em;
  font-family:  $main-font, Arial, sans-serif;
  width:365px;
  .img-name-date {
    margin: 15px;
    gap: 1.1em;
    display: flex;
    align-items: center;
    .profile-img {
      // width: 60px;
      a {
        all:unset;
        img {
                border-radius: 50%;
                width: 60px;
                height: 60px;
                object-fit: cover;
      }
      }
      
    }
    .name-date-city {
      .name {
        font-weight: 700;
        a {
          all:unset;
          cursor: pointer;
        }
      }
      .date {
        color:$gray_2 ;
      }
      .city {
        font-size: 16px;
      }
    }
    .delete-icon{
      align-self: baseline;
      width: 20px;
      margin-left:auto;
      img {
        width:100%;
        cursor: pointer;
      }
    }
  }
  a {
    all: unset;
    .description {
    color: black;
    // text-overflow: ellipsis;
    background:#9bc5dd;  
    padding: 20px;
    .type {
      color:$cool_black;
      font-size: 16px;
      font-weight:600;
    }
    p {
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
    }
  }
  }
  .engagement {
    margin: 15px;
    gap: 0.4em;
    display: flex;
    align-items: center;
    .like-icon {
      width: 20px;
      img {
        cursor: pointer;
      }
    }
    .likes {

    }
  }
}
</style>