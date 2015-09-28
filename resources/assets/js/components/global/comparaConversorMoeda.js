module.exports = {
  template: require('./comparaConversorMoeda.template.html'),

  data: function(){
    return {
      cotacao: [],
      selectedA: 1,
      selectedB: '',
      valor: 1000,
      data: '',
      resultado: '',
      resultadoSpread: '',
      simbolo: ''
    };
  },

  ready: function(){
    this.$http.get('api/currency/converter', function(data){
      var cot = [];
      this.selectedB = data.USD;
      for(var k in data){
        if (k == 'date') {
          this.data = data[k];
        }else if (k != 'eTag') {
          cot.push({text: k, value: data[k]});
        }
      }
      cot.push({text: 'BRL', value: 1});
      this.cotacao = cot;
      this.calcula();
      this.simbolo = 'USD';
    });
  },

  methods: {
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
