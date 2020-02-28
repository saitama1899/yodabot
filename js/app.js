// Header component
const navbar = {
  template: `
    <nav class="navbar navbar-dark" style="background-color: #8c695a">
      <a class="navbar-brand" href="#">
        <img src="./assets/img/yodabot.png" width="50" height="50" class="d-inline-block align-top" alt="yodabot">
         YodaBot
      </a>
    </nav>
  `
}

// Chat form component
const chat_form = {
  template: `
    <div id="chat-form-component">
      <small v-show="writing" class="form-text text-muted mb-2">YodaBot is writing...</small>
      <form class="form-inline" id="chat-form" autocomplete="off" @submit.prevent="send">
        <div class="form-group">
          <input type="text" name="message" v-model="message" class="form-control" placeholder="Say something to YodaBot"
            required required-pattern="[A-Za-z0-9]{2,50}" :disabled="writing" autofocus>
          <button type="submit" class="btn btn-primary ml-2">Send!</button>
        </div>
      </form>
    </div>
  `,
  data() {
		return {
      message: "",
      response: "",
      writing: false
		}
	},
  methods: {
    send() {
      if (this.message) {
        this.$emit('message', this.message)
        this.writing = true
        const form = document.getElementById('chat-form')
        axios
          // .post('../api/conversation.php', new FormData(form))
          .post('http://localhost/yodabot/api/conversation.php', new FormData(form))
          .then(res =>{
            this.response = res.data
            alert(res.data)
          })
          .catch(e => console.log(e))
          .finally(() => this.writing = false)

        this.message = ""
      }
    }
  }
}

// Chat component
const chat = {
  template: `
    <div id="chat">
      <ul id="messages">
        <li v-for="message in messages" :class="[message.bot ? 'bot' : 'user']">
          <b v-if="message.bot">YodaBot</b><b v-else>You</b>
          <p>{{ message.body }}</p>
        </li>
      </ul>
      <chat_form @message="userMessage"></chat_form>
    </div>
  `,
  components:{
    'chat_form': chat_form
  },
  data() {
    return {
      messages: [],
      historial: []
    }
  },
  methods: {
    userMessage(message) {
      var message = {bot: false, body: message}
      this.messages.push(message)
    }
  }
}

// Footer component
const footer = {
  template: `
    <footer>
      Eric Selva © 2020
    </footer>
  `
}


var app = new Vue({
  el: '#app',
  components:{
    'chat': chat,
    'navbar': navbar,
    'footer-cp': footer
  }
})
