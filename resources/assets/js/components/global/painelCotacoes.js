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

    var that = this;
    var socket = io('http://localhost:3000');
    socket.on('cotacao:App\\Events\\AtualizaCotacao', function(data){
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
