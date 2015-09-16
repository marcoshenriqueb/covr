var Pusher = require('pusher-js');
var Vue = require('vue');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
Vue.use(require('vue-resource'));


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
    'compara-conversor-moeda': require('./components/global/comparaConversorMoeda')
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
    }
});


router.mode = 'hash';

router.start(site, '#site');
