<template>
  <header>
      <div class="logo">
          <img src="@/assets/images/logo.png" alt="">
      </div>
      <nav>
          <!-- <ul>
              <li>Home</li>
              <li>Add Post</li>
              <li>Search</li>
              <li>My Profile</li>
              <li>Settings</li>
              <li>Log Out</li>
          </ul> -->
          <ul>
              <router-link to="/">Home</router-link>
              <router-link :to="{name:'Add'}">Add post</router-link>
              <router-link :to="{name:'Search'}">Search</router-link>
              <router-link :to="{path:'/profile/'+myid}">My Profile</router-link>
              <a>Settings</a>
              <a @click="logout" >Log Out</a>
          </ul>
      </nav>
  </header>

  <div class="phone-nav-container">
        <div class="phone-logo">
            <img src="@/assets/images/logo-phone.png" alt="">
        </div>
    <div class="phone-nav">
      <ul>
          <li><router-link to="/"><img src="@/assets/icons/home-icon.svg" alt=""></router-link></li>
          <li><router-link :to="{name:'Add'}"><img src="@/assets/icons/add-icon.svg" alt=""></router-link></li>
          <li><router-link :to="{name:'Search'}"><img src="@/assets/icons/search-icon.svg" alt=""></router-link></li>
          <li><router-link  :to="{path:'/profile/'+myid}"><img @click="refresh_fix" src="@/assets/icons/user-icon.svg" alt=""></router-link></li>
          
          <!-- <li><img src="@/assets/icons/home-icon.svg" alt=""></li>
          <li><img src="@/assets/icons/add-icon.svg" alt=""></li>
          <li><img src="@/assets/icons/search-icon.svg" alt=""></li>
          <li><img src="@/assets/icons/user-icon.svg" alt=""></li> -->
      </ul>
    </div>
  </div>
  <div class="fake-margin">
  </div>
  
</template>

<script>
export default {
    data(){
        return {
            myid:localStorage.getItem('id')
        }
    },
    methods: {
        logout(){
            localStorage.clear();
            this.$router.push({ name: 'Login' });
        },
    },
    beforeRouteUpdate(to, from, next) {
    // react to route changes...
    next();
  }
    
}
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";

header {
    z-index: 999;
    user-select: none;
    width: 100%;
    position: fixed;
    background-color: $cool_black;
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 8px 0px;
    box-shadow: 0 0 20px rgba(34, 34, 33, 0.473);
    .logo {
        width: 90px;
        // margin-right: auto;
        img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
    }
    nav {
        
        ul {
            
            display: flex;
            list-style: none;
            a {
            all: unset;
            font-size: 1.2em;
            font-family: $main-font;
            transition: all 500ms;
            cursor: pointer;
            color: $cool_white;
            border-radius: 5px;
            margin: 10px;
            padding: 10px 25px;
            &:hover{
            color: black;
            background-color: #9bc5dd;
        }
        }
        li > a{
            all: unset;
        }
        
        }
    }
}

.fake-margin {
    height: 120px;
    @include iphone6_7_8 {
    height: 100px;
        }
    }


.phone-nav-container {
    display: none;
}
@include iphone6_7_8 {
    header {
        display: none;
    }
    .phone-nav-container {
        z-index: 999;
        display: block;
        .phone-logo {
            box-shadow: 0 0 20px rgba(34, 34, 33, 0.473);
            position: fixed;
            width: 100%;
            text-align: center;
            padding: 10px 0px;
            background-color: $cool_black;
            img {
                filter: invert(99%) sepia(0%) saturate(3924%) hue-rotate(6deg) brightness(100%) contrast(95%);
                height: 35px;
            }
        }
        .phone-nav {
        box-shadow: 0 0 20px rgba(34, 34, 33, 0.473);
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        padding: 10px 0px;
        background-color: $cool_black;
        position: fixed;
        bottom: 0;
        width: 100%;
        
        
        ul {
            display: flex;
            list-style: none;
            justify-content: space-around;
            li {
                &>a {
                    all: unset;
                }
                img {            
                    filter: invert(99%) sepia(0%) saturate(3924%) hue-rotate(6deg) brightness(100%) contrast(95%);
                    width: 35px;
                    height: 35px;
                }
            }
        }
    }
    }
    
    
}

</style>