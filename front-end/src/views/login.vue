<template>
  <div class="login-body">
    <div class="container">
    <div class="first-colored-half">
        <section class="photo-container">
        <h1>Welcome to Roomaterz</h1>
        <img src="@/assets/images/login_guy.svg" alt=""> 
    </section>
    </div>
    <div class="second-colored-half">
        <section class="form-container">
      <h2>Login</h2>
      <div class="inputs-container">
        <div class="input-holder">
            <img src="@/assets/icons/mail-icon.svg" alt="">
          <input type="email" placeholder="Email" v-model="form.email" name="email" id="email-input" >
        </div>
        <div class="input-holder">
            <img src="@/assets/icons/password-icon.svg" alt="">
          <input type="password" placeholder="Password" v-model="form.password" name="password" id="password-input">
        </div>
        <div class="signin-button">
         <button @click="Submit_login">Sing in</button>
        </div>
        <div class="forgot-password">
         <p>Forgot Password?</p>
        </div>
        <div class="devider">
        </div>
        <div class="connect-with input-holder">
            <img src="@/assets/icons/mail-icon.svg" alt="">
            <span>Connect with google</span>
        </div>
         <div class="connect-with input-holder">
            <img src="@/assets/icons/mail-icon.svg" alt="">
            <p>Connect with Facebook</p>
        </div>
        <div class="register">
          <router-link :to="{name:'Register'}"> Don't have an account?</router-link>
        </div>
      </div>
    </section>
    </div>
    </div>
  </div>
</template>

<script>
import fetch from "@/assets/javascript/fetch.js";
export default {
  name: "SignIn",
  components: {},
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  methods:{
    async Submit_login() {
      const result = await fetch.auth("https://localhost/roomaterz/user/login",this.form);
        if(result.user){
          let token =result.token;
          let full_name = result.data.first_name + " " + result.data.last_name;
          localStorage.setItem("token", token);
          localStorage.setItem("id", result.data.id);
          localStorage.setItem("full_name", full_name);
          this.$router.push({ name: 'Home' });
        }
    }
  }
};
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";

.login-body {
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
          background-color: rgb(255, 204, 0);
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
          background-color: $color-indingo;
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
            gap: 30px;
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
           .register {
             a {
               all:unset;
               cursor: pointer;
             }
           }

          }
      }
     }
  }
}
</style>>

