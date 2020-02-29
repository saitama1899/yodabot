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
      <p v-show="writing" class="feedback" ><span class="spinner-border text-success" style="width: 1rem; height: 1rem;" role="status"></span><span> YodaBot is writing...</span></p>
      <form class="form-inline" id="chat-form" autocomplete="off" @submit.prevent="send">
        <div class="form-group">
          <input type="text" name="message" id="input-message" v-model="message" class="form-control" placeholder="Say something to YodaBot"
            required required-pattern="[A-Za-z0-9]{2,50}" autofocus>
          <button type="submit" class="btn btn-primary ml-2" :disabled="writing" >Send!</button>
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
          .post('../api/conversation.php', new FormData(form))
          // .post('http://localhost/yodabot/api/conversation.php', new FormData(form))
          .then(res =>{
            this.response = res.data
            this.$emit('response', this.response)
          })
          .catch(e => console.log(e))
          .finally(() =>
            this.writing = false,
          )
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
      <chat_form @message="userMessage" @response="botMessage"></chat_form>
    </div>
  `,
  components:{
    'chat_form': chat_form
  },
  data() {
    return {
      messages: []
    }
  },
  methods: {
    userMessage(message) {
      var message = {bot: false, body: message}
      this.messages.push(message)
      localStorage.setItem('historial', JSON.stringify(this.messages))
    },
    botMessage(response) {
      var response = {bot: true, body: response}
      this.messages.push(response)
      localStorage.setItem('historial', JSON.stringify(this.messages))
    },
    getHistorial() {
    	var historial = localStorage.getItem('historial')
    	if (historial) {
    		return JSON.parse(historial)
    	} else {
    		localStorage.setItem('historial', JSON.stringify([]))
    		return []
    	}
    }
  },
  created: function () {
  	this.messages = this.getHistorial()
  },
  watch: {
  	messages: function() {
      setTimeout(function() {
      	window.scrollTo(0,document.body.scrollHeight)
      }, 10)
      document.getElementById("input-message").focus()
  	}
  }
}

// App
var app = new Vue({
  el: '#app',
  components:{
    'chat': chat,
    'navbar': navbar
  }
})
