var Pusher = require('pusher-js');
var Vue = require('vue');
var VueRouter = require('vue-router');
var VueResource = require('vue-resource');
Vue.use(VueRouter);
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.config.debug = true;
var site = Vue.extend ({

  data: function(){
    return {
      activePage: this.$route.path
    };
  },

  components: {
    'painel-cotacoes': require('./components/global/painelCotacoes'),
    'compara-conversor-moeda': require('./components/global/comparaConversorMoeda'),
    'quotations-table': require('./components/global/quotationsTable')
  },

  methods: {
    changeActivePage: function(){
      var that = this;
      setInterval(function () {that.activePage = that.$route.path;}, 200);
    }
  }

});

var router = new VueRouter({
  history: true,
	saveScrollPosition: true
});

router.map({
    '/': {
      component: require('./components/routed/home')
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
      transition.redirect('/login');
    });
  }else {
    transition.next();
  }
});

router.mode = 'hash';

router.start(site, '#site');
