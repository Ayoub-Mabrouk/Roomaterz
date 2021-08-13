<template>
  <div class="messages-container">
    <!-- <PostForm/> -->
    <div class="conversations">
      <Conversationheader
        @get_conversation_id="get_conversation"
        v-for="conversation in conversations"
        :key="conversation.conversation_id"
        :conversation="conversation"
      />
    </div>
    <div class="chat">
      <div class="messages">
        <Chat  v-for="chat in chats" :key="chat.created_at" :chat="chat" />
      </div>
      <div v-if="user_info && user_info.id > 0" class="reply-area">
        <textarea
          class="text-area"
          v-model.trim="message.reply"
          
          
        ></textarea>
        <button class="btn-send" @click="send_reply"></button>
      </div>
    </div>
  </div>
</template>

<script>
import Conversationheader from "../components/Conversation-header.vue";
import Chat from "../components/chat-one-one.vue";
import jscript from "@/assets/javascript/fetch.js";
export default {
  components: { Conversationheader, Chat },
  data() {
    return {
      conversations: [],
      chats: [],
      user_info: [],
      my_info: [],
      message: {
        mine: 1,
        created_at: "",
        profile_img: "",
        reply: "",
      },
    };
  },
  methods: {
    async my_conversations() {
      let token = localStorage.getItem("token");
      if (token) {
        this.conversations = await jscript.post(
          "https://localhost/roomaterz/chat/my_conversations",
          "",
          token
        );
        console.table(this.conversations);
      } else {
        this.conversations = false;
      }
    },
    async my_informations() {
      let token = localStorage.getItem("token");
      if (token) {
        this.my_info = await jscript.post(
          "https://localhost/roomaterz/user/user_info",
          { user_id: localStorage.getItem("id") },
          token
        );
        console.table(this.my_info);
      } else {
        this.my_info = false;
      }
    },
    async get_conversation(conversation_id, user_id) {
      let token = localStorage.getItem("token");
      console.log(user_id);
      if (token) {
        this.user_info = await jscript.post(
          "https://localhost/roomaterz/user/user_info",
          { user_id: user_id },
          token
        );
        this.chats = await jscript.post(
          "https://localhost/roomaterz/chat/conversation",
          { conversation_id: conversation_id },
          token
        );
        console.table(this.chats);
        console.table(this.user_info);
      } else {
        this.chats = false;
      }
    },
    async send_reply() {
      var today = new Date();
      var date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
      var time =
        today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      var dateTime = date + " " + time;
      this.message.created_at = dateTime;
      this.message.profile_img = this.my_info.profile_img;
      this.chats.push({ ...this.message });
      let token = localStorage.getItem("token");
      await jscript.post(
        "https://localhost/roomaterz/chat/send_message",
        { reciever_id: this.user_info.id, reply: this.message.reply },
        token
      );
    },
  },
  async beforeMount() {
    await this.my_conversations();
    this.get_conversation(
      this.conversations[0].conversation_id,
      this.conversations[0].user_id
    );
    this.my_informations();
  },
};
</script>

<style lang="scss">
@import "@/assets/scss/_shared_style.scss";
.messages-container {
  display: flex;
  align-items: stretch;
  justify-content: center;
  gap: 60px;
  height: 100%;
  .conversations {
    margin-left: 20px;
    display: inline-block;
    height: 85vh;
    overflow: scroll;
    &::-webkit-scrollbar {
      display: none;
    }
  }
  .chat {
    display: grid;
    grid-template-rows:1fr auto;

    // overflow: scroll;
    height: 85vh;
    padding: 0px 20px;
    width: 50%;
    margin: 12px 0px;
    border-radius: 20px;
    background-color: rgb(170, 185, 185);
    .messages {
      grid-row: 1/2;
      height: 100%;
      overflow: auto;
    }
    .reply-area {    
      grid-row: 2/-1;
      border-radius: 20px;
      display: flex;
      padding: 10px;
      min-height: 100px;
      width: 100%;
  
      .text-area {
        border-top-left-radius: 17px;
        border-bottom-left-radius: 17px;
        width: 90%;
        max-width: 90%;
        min-width: 150px;
        border: none;
        outline: none;
        padding: 10px;
        font-size: 18px;
        &:focus{
          padding-left: 18px;
        }
      }
      .btn-send {
        width: 10%;
        border-top-right-radius: 17px;
        border-bottom-right-radius: 17px;
        border: none;
        outline: none;
        background-image: url('../assets/icons/send-icon.svg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: 60%;
        background-color: #9bc5dd;

        &:hover{
            cursor: pointer;
            background-size: 80%;
            
        }
        
      }
    }
  }
}
</style>