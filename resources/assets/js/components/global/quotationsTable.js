module.exports = {
  template: require('./quotationsTable.template.html'),

  data: function(){
    return {
      cotacao: {}
    }
  },

  props: [
    'cotacao'
  ]

}
