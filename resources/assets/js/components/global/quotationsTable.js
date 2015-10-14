module.exports = {
  template: require('./quotationsTable.template.html'),

  data: function(){
    return {
      cotacao: {
        USD: {preco:'',variacao:'',ticker:'',color:'',currency:''},
        CAD: {preco:'',variacao:'',ticker:'',color:'',currency:''},
        AUD: {preco:'',variacao:'',ticker:'',color:'',currency:''},
        EUR: {preco:'',variacao:'',ticker:'',color:'',currency:''},
        GBP: {preco:'',variacao:'',ticker:'',color:'',currency:''},
        CLP: {preco:'',variacao:'',ticker:'',color:'',currency:''},
        ARS: {preco:'',variacao:'',ticker:'',color:'',currency:''},
        MXN: {preco:'',variacao:'',ticker:'',color:'',currency:''}
      }
    }
  },

  props: [
    'cotacao'
  ]

}
