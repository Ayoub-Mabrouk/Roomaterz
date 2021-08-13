<template>
  <div class="content">
      <div class="postform-container">
        <div class="description">
            <textarea v-model="form.description" name="Description" placeholder="Description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="choices">
            <TypeSelect @gettypeid="settypeid" />
            <CitySelect @getcityid="setcityid" />
        </div>
      <div class="publish">
          <button @click="submit_post">Publish</button>
      </div>
  </div>
  </div>
</template>

<script>
import TypeSelect from '../components/TypeSelect.vue'
import CitySelect from '../components/CitySelect.vue'
import jscript from "@/assets/javascript/fetch.js";

export default {
    components:{TypeSelect,CitySelect},
    data(){
        return {
            form : {
                description:"",
                city_id:"",
                type_id:""
            }
        }
    },
    methods:{
        setcityid(city_id){
            this.form.city_id=city_id;
        },
        settypeid(type_id){
            this.form.type_id=type_id;
        },
        async submit_post(){
            let token=localStorage.getItem('token')
            if(token){
                let res= await jscript.post('https://localhost/roomaterz/post/create_post',this.form,token);
                this.$router.push({ name: 'Home' });
            }
        }
    }
}
    
</script>

<style scoped lang="scss">

@import "@/assets/scss/_shared_style.scss";
* {
    font-size: 19px;
}
.postform-container {  
    
    gap: 15px;
    font-family: $main-font;
    user-select: none;
    border-radius: 10px;
    box-shadow: 0px 0px 25px rgba(34, 33, 33, 0.486);
    box-sizing: border-box;
    padding: 20px;
    margin: 0 auto;
    background-color: $under_cool_black;
    display: flex;
    flex-direction: column;
    width: 44%;
              @include iphone6_7_8{
                  width: 400px;
                  margin: 20% auto;
              }
    
    .description {        
        textarea {
            border: none;
            color: grey;
            font-weight: 600;
            outline: none;
            resize: none;
            border-radius: 10px;
            background-color: $primary-bg-color;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
            
            box-sizing: border-box;
            padding: 10px;
            width: 100%;
            height: 100px;
        }
    }
    
    .choices {
        justify-content: space-between;
        display: flex;
        flex-direction: row;
        gap:0px;
        @include iphone6_7_8{
                 flex-direction: column;
                 width:100%;
                 align-items: center; 
                 gap:20px;
              }
       
        div {
            select {
                text-align: center;
                border: none;
                color: grey;
                font-weight: 600;
                background-color: rgb(242, 242, 247);
                font-family: $main-font;
                outline: none;
                padding: 0 25px;
                border-radius: 10px;
                height: 40px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
            }
        }
    }
    .publish {
        text-align: center;
        button {
            width: 100%;
            color: rgb(242, 242, 247);
            border-radius: 4px;
            height: 40px;
            padding: 0 40px;
            background-color: #5ea2f5;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
            transition:all 600ms;
            @include iphone6_7_8{
                  width: 250px;
                  
              }
            &:hover {
                color: rgb(255, 255, 255);
                background-color: #7ab1f5;
                }
            }
    }

}

</style>