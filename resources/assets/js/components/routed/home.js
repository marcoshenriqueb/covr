module.exports = {
  template: require('./home.template.html'),

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
      }
    };
  }
};
