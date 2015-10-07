var Vue = require('vue');
var VueRouter = require('vue-router');
var VueResource = require('vue-resource');
window.Drop = require('dropzone');
Vue.use(VueRouter);
Vue.use(VueResource);
window.moment = require('moment');
window.socket = io('http://localhost:3000');

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.config.debug = false;
Vue.transition('slide', {
  enter: function (el, done) {
    // element is already inserted into the DOM
    // call done when animation finishes.
    $(el)
      .css('display', 'none')
    setTimeout(function(){
      $(el)
        .slideDown(250, done)
    }, 250)

      // .animate({ opacity: 1 }, 1000, done)
  },
  enterCancelled: function (el) {
    $(el).stop()
  },
  leave: function (el, done) {
    // same as enter
    $(el)
    .slideUp(250, done)
    // .animate({ opacity: 0 }, 1000, done)
  },
  leaveCancelled: function (el) {
    $(el).stop()
  }
});
var app = Vue.extend ({

  data: function(){
    return {
      user: {}
    };
  },

  components: {
    'painel-cotacoes': require('./components/global/painelCotacoes'),
    'compara-conversor-moeda': require('./components/global/comparaConversorMoeda')
  },

  ready:function(){
    this.$http.get('api/user').success(function(data){
      this.user = data;
      window.socket.on('connect', function(){
        window.socket.emit('user_id', {user_id: this.user.id});
      }.bind(this));
    });
  }


});
var router = new VueRouter({
  history: true,
	saveScrollPosition: true
});
window.router = router;
router.map({
    '/': {
      component: require('./components/routed/home')
    },
    '/app' :{
      component: require('./components/routed/painel'),
      auth: true
    },
    '/perfil' :{
      component: require('./components/routed/perfil'),
      auth: true
    },
    '/contatos' :{
      component: require('./components/routed/contatos'),
      auth: true
    },
    '/login': {
      component: require('./components/routed/login')
    },
    '/cadastro': {
      component: require('./components/routed/cadastro')
    },
    '/confirma-email': {
      component: require('./components/routed/confirmaEmail')
    }
});

router.beforeEach(function(transition){
  if (transition.to.auth) {
    var response;
    $.get('auth/check')
      .done(function(xhr){
      transition.next();
    }).fail(function(xhr){
      window.location.href = "/login";
    });
  }else {
    transition.next();
  }
});

router.mode = 'hash';

router.start(app, '#app');
