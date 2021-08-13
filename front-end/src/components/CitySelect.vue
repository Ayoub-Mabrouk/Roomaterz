<template>
  <div class="post-city">
            <select @input="$emit('getcityid', $event.target.value)" name="post-city" id="">
                <option value="" selected disabled>Choose City</option>
                <option  v-for="city in cities" :key="city.id" :value="city.id">{{ city.city }}</option>
            </select>
        </div>
</template>

<script>
import jscript from "@/assets/javascript/fetch.js";

export default {
    data(){
        return {
            cities:[]
        }
    },
    methods:{
        async all_cities(){
            let token=localStorage.getItem('token')
            if(token){
                this.cities= await jscript.post('https://localhost/roomaterz/post/all_cities','',token);
            }
            else {
                this.cities=false;
            }
        },
    },
    beforeMount(){
        this.all_cities();
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";

div {
            select {
                width: 300px;
                text-align-last:center;
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
</style>