var Vue = require('vue');
var VueRouter = require('vue-router');
var VueResource = require('vue-resource');
var VueTouch = require('vue-touch');
Vue.use(VueTouch);
window.Drop = require('dropzone');
Vue.use(VueRouter);
Vue.use(VueResource);
window.moment = require('moment');
window.socket = io('http://localhost:3000');



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
      user: null,
      messagesNotRead: 0
    };
  },

  components: {
    'painel-cotacoes': require('./components/global/painelCotacoes'),
    'compara-conversor-moeda': require('./components/global/comparaConversorMoeda'),
    'quotations-table': require('./components/global/quotationsTable')
  },

  ready:function(){
    var that = this;
    var initRecur = function rec (){
      var user = document.getElementById("user-set").getAttribute('value');
      if (user.trim() != '' && user != undefined) {
        if (user == 1) {
          Vue.http.headers.common['Authorization'] = 'Bearer ' + document.getElementById('token').getAttribute('value');
          that.initSocket();
          that.getNotRead();
        }
      }else {
        setTimeout(function(){
          rec();
        }, 50);
      }
    }
    initRecur();
  },

  methods: {
    initSocket: function(){
      this.$http.get('api/user').success(function(data){
        this.user = data;
        window.socket.on('connect', function(){
          window.socket.emit('user_id', {user_id: this.user.id});
        }.bind(this));
      });
    },
    getNotRead: function(){
      this.$http.get('api/message/notread')
      .success(function(data){
        this.messagesNotRead = data;
      })
      .error(function(data){
        console.log(data);
      });
    }
  }

});

var router = new VueRouter({
  history: true,
	saveScrollPosition: true
});
window.router = router;

router.map({
    '/painel': {
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
    Vue.http.get('auth/check')
      .success(function(data){
      transition.next();
    }).error(function(data){
      window.location.href = "auth/logout";
    });
  }else {
    transition.next();
  }
});

router.mode = 'html5';

router.start(app, '#app');
