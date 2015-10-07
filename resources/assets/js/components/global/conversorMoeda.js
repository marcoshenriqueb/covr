module.exports = {
  template: require('./conversorMoeda.template.html'),

  data: function(){
    return {
      cotacao: [],
      selectedA: 1,
      selectedB: '',
      valor: 100,
      data: '',
      resultado: '',
      simbolo: ''
    };
  },

  ready: function(){
    this.$http.get('api/currency/converter', function(data){
      console.log(data);
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
