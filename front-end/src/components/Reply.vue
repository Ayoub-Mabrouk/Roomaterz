<template>
  
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