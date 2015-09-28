module.exports = {
  template: require('./painelCotacoes.template.html'),

  data: function(){
    return {
      cotacao: {
        USD: {preco:'',variacao:''},
        CAD: {preco:'',variacao:''},
        AUD: {preco:'',variacao:''},
        EUR: {preco:'',variacao:''},
        GBP: {preco:'',variacao:''},
        CLP: {preco:'',variacao:''},
        ARS: {preco:'',variacao:''},
        MXN: {preco:'',variacao:''}
      },
      animate:false,
      USDcolor: '',
      CADcolor: '',
      AUDcolor: '',
      EURcolor: '',
      GBPcolor: '',
      CLPcolor: '',
      ARScolor: '',
      MXNcolor: ''
    }
  },

  ready: function(){
    this.$http.get('api/currency/latest', function(data){
      this.parseCot(data);
    });

    var pusher = new Pusher('bdeb580ff7d67b3c3cf6', {
      encrypted: true
    });
    var channel = pusher.subscribe('cotacao');
    var v = this;
    channel.bind('App\\Events\\AtualizaCotacao', function(data) {
      v.animate = true;
      var p = JSON.parse(data.cotacao);
      v.parseCot(p);
      setTimeout(function () {v.animate = false;}, 5000);
    });
  },

  methods: {
    parseCot: function(c){
      var ar = {};
      for(var k in c){
        var variacao = (c[k].var * 100).toFixed(2) + "%";
        ar[k] = {preco: k + " " + Number(c[k].cot).toFixed(2), variacao: variacao};
        if (c[k].var > 0) {
          this[k + 'color'] = 'text-success';
        }else if (c[k].var < 0) {
          this[k + 'color'] = 'text-danger';
        }
      }
      this.cotacao = ar;
    }
  },

  props: [
    'cotacao'
  ]
};
