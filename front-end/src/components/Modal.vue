<template>
  <div class="backdrop">
    <div class="modal">
        <h1>modal hello</h1>
      <p>Modal content</p>
    </div>
  </div>
</template>
<style  scoped lang="scss">
@import '@/assets/scss/shared_style.scss';
.backdrop {

 h1 {
     color: $blue;
 }
  top: 0;
  position: fixed;
  background: rgba(58, 47, 47, 0.178);
  width: 100%;
  height: 100%;
  .modal {
      font-family:'Trebuchet MS', Arial, sans-serif;
    width: 400px;
    padding: 20px;
    margin: 100px auto;
    background: rgba(231, 69, 69, 0.438);
    border-radius: 10px;
  } 
}
</style>