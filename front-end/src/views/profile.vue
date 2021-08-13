<template>
  <div class="profile-container">
      <div class="img-name">
          <div class="img">
              <label id="img_input_label" for="photo_upload">
                  <img  class="edit-overlay" v-if="user_id==myid" src="@/assets/icons/camera-icon.svg" alt="">
                  <input v-on:change="change_image" type="file" accept="image/jpg, image/jpeg" style="display:none;" name="" id="photo_upload">
              </label>
              <img id="user_img"  :src="[user_info.profile_img && user_info.profile_img.length>0?'https://localhost/roomaterz/public/storage/images/'+user_info.profile_img:require('@/assets/icons/unknown-user-icon.svg')]" alt="">
            </div>
           <button id="change_image" @click="submit_profile_image" style="display:none;" v-if="user_id==myid">Change Image</button>
           <p>{{user_info.name}}</p>
      </div>
      <div class="informations">
          <div class="age">
              <div class="age-icon"><img src="@/assets/icons/birthday-icon.svg" alt=""></div>
              <p>{{getage()}}</p>
          </div>
          <div class="location">
              <div class="location-icon"><img src="@/assets/icons/birthday-icon.svg" alt=""></div>
              <p>{{user_info.city}}</p>
          </div>
          <div class="email">
              <div class="email-icon"><img src="@/assets/icons/mail-icon.svg" alt=""></div>
              <p>{{user_info.email}}</p>
          </div>
          <div class="phone">
              <div class="phone-icon"><img src="@/assets/icons/mail-icon.svg" alt=""></div>
              <p>{{user_info.phone}}</p>
          </div>
      </div>
  </div>
</template>

<script>
import jscript from "@/assets/javascript/fetch.js";

export default {
    data(){
        return {
            myid:localStorage.getItem('id'),
            user_id:this.$route.params.id,
            user_info:[],
        }
    },
    methods:{
        async get_userinfo(){
            let token=localStorage.getItem('token')
            if(token){
                this.user_info= await jscript.post('https://localhost/roomaterz/user/user_info',{user_id:this.user_id},token);
                console.table(this.user_info)
                console.log(this.user_info.profile_img.length);
            }
            else {
                this.user_info=[];
            }
        },
        getage(){
            return Math.floor((new Date() - new Date(this.user_info.birth_date).getTime()) / 3.15576e+10)
        },
        change_image(event) {
        document.getElementById("user_img").src = URL.createObjectURL(event.target.files[0]);
        document.getElementById("change_image").style.display = 'inline';
        },
        async submit_profile_image(){
            document.getElementById('change_image').style.display='none';
            let image=document.getElementById('photo_upload');
            let token=localStorage.getItem('token');
            if(token){
                
                var formdata = new FormData();
                formdata.append("image", image.files[0]);

                const response = await fetch("https://localhost/roomaterz/user/profile_photo",{
                    method: "POST",
                    headers: {
                        "accept": "application/json",
                        "Authorization": `Bearer ${token}`
                    },
                    body: formdata
                } )
                const result = await response.json();
                console.log(result);
                }
        }
            
            
    },
    beforeMount(){
        this.get_userinfo()
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";
.profile-container {
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.507);
    box-sizing: border-box;
    width: 500px;
    margin: 0 auto;
    background-color: rgb(131, 104, 54);
    border-radius: 10px;
    @include iphone6_7_8{
            width: 350px;
           }
    .img-name {
        box-sizing: border-box;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        padding: 20px;
        background-color: rgb(90, 70, 33);
        width: 100%;
        text-align: center;
        // display: flex;
        .img {
            position: relative;
           .edit-overlay {
               border-radius: 50%;
                width: 190px;
                height: 190px;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
               position: absolute;
               opacity: 0%;
               transition: all 500ms;
               &:hover  {
                   opacity: 100%;
                   background-color: rgba(53, 50, 50, 0.507);
               }
            .edit-overlay:hover + #user_img {
                background-color: rgba(141, 19, 19, 0.507);
            }
           }
            img {
                border-radius: 50%;
                width: 200px;
                height: 200px;
                object-fit: cover;
            }
        }
        #change_image {
            margin: 10px 0px;
            cursor: pointer;
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 12px 23px;
            text-align: center;
            border-radius: 20px;
            font-size: 16px;
        }
        p{
            font-size: 30px;
            padding-top: 10px;
        }
    }
    .informations {
        box-sizing: border-box;
        padding: 20px;
        display: flex;
        flex-direction: column;
        font-size: 20px;
        width: fit-content;
        margin: 0 auto;
        justify-content: space-around;
        height: 230px;

        & > div{
            display: flex;
            align-items: center;
            gap: 10px;
            & > div {
                width: 20px;
                img {
                    width:100%;
                }
            }
        }
        @include iphone6_7_8{
            height: 220px;
           }
    }
}


</style>