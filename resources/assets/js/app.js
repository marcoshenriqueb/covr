var Pusher = require('pusher-js');
var Vue = require('vue');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
Vue.use(require('vue-resource'));


Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.config.debug = true;
var app = Vue.extend ({

  data: function(){
    return {
      activePage: this.$route.path
    };
  },

  components: {
    'painel-cotacoes': require('./components/global/painelCotacoes'),
    'conversor-moeda': require('./components/global/conversorMoeda')
  },

  methods: {
    changeActivePage: function(){
      this.activePage = this.$route.path;
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

router.start(app, '#app');
