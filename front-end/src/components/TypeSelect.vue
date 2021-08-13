<template>
    <div class="post-type">
            <select @input="$emit('gettypeid', $event.target.value)" name="post-type" id="">
                <option value=""  selected disabled>Choose Post Type</option>
                <option v-for="type in types" :key="type.id" :value="type.id">{{ type.type }}</option>
            </select>
    </div>
</template>

<script>
import jscript from "@/assets/javascript/fetch.js";

export default {
    data(){
        return {
            types:[]
        }
    },
    methods:{
        async all_types(){
            let token=localStorage.getItem('token')
            if(token){
                this.types= await jscript.post('https://localhost/roomaterz/post/all_types','',token);
            }
            else {
                this.types=false;
            }
        }
    },
    beforeMount(){
        this.all_types();
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/scss/_shared_style.scss";

div {
            select {
                width: 300px;
                text-align-last:center;
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
                option {
                    text-align:center;
                }
            }
        }
</style>