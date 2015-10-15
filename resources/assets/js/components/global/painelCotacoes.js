module.exports = {
  template: require('./painelCotacoes.template.html'),

  data: function(){
    return {
      cotacao: {
        USD: {preco:'',variacao:'',ticker:'',color:''},
        CAD: {preco:'',variacao:'',ticker:'',color:''},
        AUD: {preco:'',variacao:'',ticker:'',color:''},
        EUR: {preco:'',variacao:'',ticker:'',color:''},
        GBP: {preco:'',variacao:'',ticker:'',color:''},
        CLP: {preco:'',variacao:'',ticker:'',color:''},
        ARS: {preco:'',variacao:'',ticker:'',color:''},
        MXN: {preco:'',variacao:'',ticker:'',color:''}
      },
      animate:false
    }
  },

  props: [
    'cotacao'
  ],

  ready: function(){
    this.$http.get('api/currency/latest').success(function(data){
      this.parseCot(data);
    });

    var that = this;
    window.socket.on('cotacao:App\\Events\\AtualizaCotacao', function(data){
      that.animate = true;
      var p = JSON.parse(data.cotacao);
      that.parseCot(p);
      setTimeout(function () {that.animate = false;}, 5000);
    });
  },

  methods: {
    parseCot: function(c){
      var ar = {};
      for(var k in c){
        var variacao = (c[k].var * 100).toFixed(2) + "%";
        var color = c[k].var > 0 ? 'text-success' : c[k].var < 0 ? 'text-danger' : '';
        ar[k] = {
          ticker: k,
          preco: Number(c[k].cot).toFixed(2),
          variacao: variacao,
          color: color,
          currency: c[k].currency
        };
      }
      this.cotacao = ar;
    }
  }

};
