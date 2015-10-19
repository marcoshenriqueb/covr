var Vue = require('vue');
var VueResource = require('vue-resource');
Vue.use(VueResource);

var vm = new Vue({
  el: 'body',

  data: {
    nome: '',
    sobrenome: '',
    email: '',
    password: '',
    displayErrors: false,
    warning: ''
  },

  methods: {
    registerSubmit: function(){
      this.registerValidate();
      this.register();
    },
    registerValidate: function(){
      this.displayErrors = true;
      this.warning = 'warning';
      setTimeout(function(){
        this.displayErrors = false;
        this.warning = '';
      }.bind(this), 3000);
    },
    register: function(){

    }
  }
});
