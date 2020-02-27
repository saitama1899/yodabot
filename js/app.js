const navbar = {
  template: `
    <nav class="navbar navbar-dark" style="background-color: #8c695a">
      <a class="navbar-brand" href="#">
        <img src="./assets/img/yodabot.png" width="50" height="50" class="d-inline-block align-top" alt="yodabot">
          yodabot
      </a>
    </nav>
  `
}

const chat = {
  template: `
    <div id="chat">
      <ul id="messages"></ul>
      <small id="feedback" class="form-text text-muted mb-2">We'll never share your email with anyone else.</small>
      <form class="form-inline" id="chat-form" autocomplete="off" @submit.prevent="send">
        <div class="form-group">
          <input type="text" class="form-control" name="message" placeholder="Send your message" required required-pattern="[A-Za-z0-9]{1,50}">
          <button type="submit" class="btn btn-primary ml-2">Send</button>
        </div>
      </form>
    </div>
  `
}

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
