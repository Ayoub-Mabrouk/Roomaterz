<template>
  <Post class="post" :post="post" />
</template>

<script>
import Post from '../components/Post.vue'
import jscript from "@/assets/javascript/fetch.js";

export default {

  components: {Post },
  data(){
      return {
          post_id:this.$route.params.post_id,
          post:[]
      }
  },
  methods:{
    async one_post(){
      let token=localStorage.getItem('token')
      if(token){
        this.post= await jscript.post('https://localhost/roomaterz/post/one_post',{post_id:this.post_id},token);
        console.table(this.post)
      }
      else {
        this.post=false;
      }
    }
  },
  beforeMount(){
    this.one_post()
  }

}
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";
 .post {
    margin: 0 auto;
    //overridding some styles in the post compenent
   ::v-deep(.description) {
        p { 
            all: unset; 
        }
    }
}

</style>