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
      form:{
        type_id:this.$route.params.type_id,
        city_id:this.$route.params.city_id,
      },
      posts:[],
    }
  },
  methods:{
    async search_all_posts(){
      let token=localStorage.getItem('token')
      if(token){
        this.posts= await jscript.post('https://localhost/roomaterz/post/search_posts',this.form,token);
        console.table(this.posts)
      }
      else {
        this.posts=false;
      }
    }
  },
  beforeMount(){
    this.search_all_posts()
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