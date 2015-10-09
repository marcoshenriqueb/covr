module.exports = {
  template: require('./comparaConversorMoeda.template.html'),

  data: function(){
    return {
      cotacao: null,
      arrayCotacao: [],
      selectedA: 1,
      selectedB: '',
      valor: 1000,
      data: '',
      resultado: '',
      resultadoSpread: '',
      simbolo: ''
    };
  },

  props: [
    'cotacao'
  ],

  ready: function(){
    var that = this;
    var initRecur = function rec (){
      if (that.cotacao != null && typeof that.cotacao == 'object') {
        that.initCalc();
      }else {
        setTimeout(function(){
          rec();
        }, 50);
      }
    }
    initRecur();
  },

  methods: {
    initCalc: function(){
      var r = [];
      r[0] = {text: 'BRL', value: 1};
      for(var k in this.cotacao){
        r.push({text: k, value: this.cotacao[k].preco});
      }
      this.arrayCotacao = r;
      this.selectedB = this.cotacao.USD.preco;
      this.calcula();
    },
    calcula: function(){
      this.resultado = ((this.selectedA / this.selectedB) * this.valor).toFixed(2);
      this.resultadoSpread = (((this.selectedA / this.selectedB) * 0.90 ) * this.valor).toFixed(2);
      var that = this;
      setTimeout(function () {that.simbolo = $('#simbolo option:selected').text();}, 200);
    },
    inverte: function(){
      var a = this.selectedA;
      this.selectedA = this.selectedB;
      this.selectedB = a;
      this.calcula();
    }
  }
};
