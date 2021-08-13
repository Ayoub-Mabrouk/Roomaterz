<template>
<!-- <Margin h="120px" /> -->
  <div class="home-container">
    <!-- <PostForm/> -->
    <div  class="posts">
      <Post v-for="post in posts"  :key="post.post_id" :post="post" />
      
    </div> 
  </div>
</template>
<script>

import Post from '../components/Post.vue'
import jscript from "@/assets/javascript/fetch.js";
export default {
  components: { Post },
  data(){
    return {
      posts:[],
    }
  },
  methods:{
    async my_interests(){
      let token=localStorage.getItem('token')
      if(token){
        let posts = await jscript.post('https://localhost/roomaterz/interest/my_interests','',token);
        this.posts=posts.map(obj=> ({ ...obj, liked: '1' }))
        console.table(posts)
      }
      else {
        this.posts=false;
      }
    }
  },
  beforeMount(){
    this.my_interests()
  }
}
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";
.home-container {
    margin: 0 auto;
    width: 75%;
    margin-bottom: 100px;
    @include iphone6_7_8 {
      width: 100%;
    }
  .posts {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(365px,1fr));
    gap: 3em;
    place-items: center;
    @include iphone6_7_8 {
      gap: 4em;
    }
    a {
      all: unset;
    }
  }
}
</style>