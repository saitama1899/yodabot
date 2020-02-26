const chat = {
  template: `
    <p>Chat component</p>
  `
}

var app = new Vue({
  el: '#app',
  components:{
    'chat': chat
  }
})
