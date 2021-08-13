<template>
  <div class="register-body">
    <div class="container">
    <div class="first-colored-half">
        <section class="photo-container">
        <h1>find your type of roomates</h1>
        <img src="@/assets/images/login_guy.svg" alt=""> 
    </section>
    </div>
    <div class="second-colored-half">
      <section class="form-container">
        <h2>Register</h2>
        <form v-on:submit.prevent >
          <div class="inputs-container">
          <div class="input-holder">
              <img src="@/assets/icons/name-icon.svg" alt="">
            <input type="text" v-model="form.first_name" required placeholder="First Name" name="first_name" id="first_name-input" >
          </div>
          <div class="input-holder">
              <img src="@/assets/icons/name-icon.svg" alt="">
            <input type="text" v-model="form.last_name" required placeholder="Last Name" name="last_name" id="last_name-input" >
          </div>
          <div class="input-holder">
              <img src="@/assets/icons/gender-icon.svg" alt="">
              <select v-model="form.gender"  name="gender" id="" required>
                <option value="" selected disabled>Your Gender</option>
                <option value="Man">Man</option>
                <option value="Woman">Woman</option>
              </select>
          </div>
          <div class="input-holder">
              <img src="@/assets/icons/location-icon.svg" alt="">
              <select v-model="form.location" required name="location" id="">
                <option value="" selected disabled>Choose City</option>
                <option  v-for="city in cities" :key="city.id" :value="city.id">{{ city.city }}</option>
              </select>
          </div>
          <div class="input-holder">
              <img src="@/assets/icons/birthday-icon.svg" alt="">
            <input v-model="form.birth_date" required type="date" placeholder="Email" name="birth_date" id="birth_date-input" >
          </div>
          <div class="input-holder">
              <img src="@/assets/icons/mail-icon.svg" alt="">
            <input v-model="form.email" type="email" placeholder="Email" name="email" id="email-input" >
          </div>
          <div class="input-holder">
              <img src="@/assets/icons/password-icon.svg" alt="">
            <input v-model="form.password" required type="password" placeholder="Password" name="password" id="password-input">
          </div>
          <div class="signin-button">
          <button type="submit" @click="register">Sing up</button>
          </div>
          <div class="message">
            
          </div>

          <div class="devider">
          </div>
          <div class="connect-with input-holder">
              <img src="@/assets/icons/mail-icon.svg" alt="">
              <span>Sign up with google</span>
          </div>
          <div class="connect-with input-holder">
              <img src="@/assets/icons/mail-icon.svg" alt="">
              <p>Sign up with Facebook</p>
          </div>
          <div class="log-in">
          <router-link :to="{name:'Login'}"> Already have an account?</router-link>
          </div>
        </div>
        </form>
    </section>
    </div>
    </div>
  </div>
</template>

<script>
import jscript from "@/assets/javascript/fetch.js";

export default {
  data(){
    return {
      cities:[],
      form : {
        first_name:"",
        last_name:"",
        location:"",
        gender:"",
        birth_date:"",
        email:"",
        phone:"",
        password:"",
        profile_img:""
      }
    }
  },
  methods:{
    async all_cities(){
      this.cities= await jscript.post('https://localhost/roomaterz/post/all_cities','','');
    },
    async register(){
      console.table(this.form);
      const result = await jscript.auth("https://localhost/roomaterz/user/register",this.form);
        if(result){
           this.$router.push({ name: 'Login'});
        }else {
          document.querySelector('.message').innerHTML='<p>Register Failed, Try again</p>'
        }
    }
  },
  beforeMount(){
    this.all_cities()
  }
};

</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";

.register-body {
    font-family: $main-font;
  position: absolute;
  height: 100%;
  width: 100%;
  background-color: $primary-bg-color;
  @include iphone6_7_8{
            height: unset;
           }
  .container {
    //   margin: 150px auto;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      @include iphone6_7_8 {
          display: flex;
          flex-direction: column;
          align-items: center;
          // justify-content: space-between;
          align-content: space-around;
          }
      .first-colored-half {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          background-color: rgb(50, 173, 230);
          width: 50%;
          @include iphone6_7_8 {
            width: 100%;
            height: 30%;
            background-color: unset;
          }
          .photo-container {  
           width: 70%;
           @include iphone6_7_8{
             margin-top: 4%;
             width: 70%;
           }
        h1{
            text-align: center;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 2em;
            margin-bottom: 2em;
            @include iphone6_7_8{
             margin-bottom: 0.5em;
           }
        }
        img {
            width:100%;
        }
          
      }
      }
     .second-colored-half {
       
         display: flex;
         justify-content: center;
         width: 50%;
         @include iphone6_7_8{
           margin-top: 0.6em;
            width: 100%;
           }
          .form-container {
          border-radius: 10px;
          box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.25);
          padding: 30px;
          align-items: center;
          width: 60%;
          display: flex;
          gap :30px;
          flex-direction: column;
          background-color: $color-yellow;
          @include iphone6_7_8{
            box-shadow: unset;
            background-color: unset;
           }
          h2 {  
              font-size: 30px;
              @include iphone6_7_8{
              display: none;
           }
          }
          .inputs-container {
              
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            .input-holder {
                border-radius: 4px;
                display: flex;
                align-items: center;
                width: 300px;
                height: 40px;
                    background-color: rgb(242, 242, 247);
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);

                img {
                    width: 20px;
                    height: 20px;
                    margin: 0 10px;
                }
                input {
                    background-color: rgb(242, 242, 247);

                    width: 220px;
                    outline: none;
                    border: none;
                }
                input::placeholder{
                    color: grey;
                    font-weight: 600;
                }
                select {
                    color: grey;
                    font-weight: 600;
                    background-color: rgb(242, 242, 247);
                    width: 100%;
                    outline: none;
                    border: none;
                    option {
                      color: grey;
                      font-weight: 600;
                    }
                }
                input[type=date]{
                  background-color: rgb(242, 242, 247);
                    width: 100%;
                    outline: none;
                    border: none;
                }
            }
            .signin-button {
                button {
                    color: rgb(242, 242, 247);
                    border-radius: 4px;
                    height: 40px;
                    padding: 0 60px;
                    background-color: #5ea2f5;
                    border: none;
                outline: none;
                cursor: pointer;
                font-size: 18px;
                font-weight: 600;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
                transition:all 600ms;
                 &:hover{
                      color: rgb(255, 255, 255);
                    background-color: #7ab1f5;
                }
                }
               

            }
            .devider {
                background-color: #000000;
                height: 1px;
                width:250px;
            }
           .connect-with {
               font-weight: 700;
               width: 260px;
                height: 40px;
                    background-color: rgb(231, 226, 226);

           }
           .log-in {
             a{
               all: unset;
               cursor: pointer;
             }
           }

          }
      }
     }
  }
}
</style>>

