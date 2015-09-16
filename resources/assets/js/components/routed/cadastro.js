module.exports = {
  template: require('./cadastro.template.html'),

  data: function(){
    return {
      nome: '',
      sobrenome: '',
      email: '',
      password: '',
      password_confirmation: '',
      nomeInvalid: false,
      sobrenomeInvalid: false,
      emailInvalid: false,
      passwordInvalid: false
    };
  },

  methods: {
    validaNome: function(){
      if (this.nome.length > 0 && this.nome.length < 255) {
        this.nomeInvalid = false;
      }else {
        this.nomeInvalid = 'O nome tem que ter entre 0 e 255 caracteres';
      }
    },
    validaSobrenome: function(){
      if (this.sobrenome.length > 0 && this.sobrenome.length < 255) {
        this.sobrenomeInvalid = false;
      }else {
        this.sobrenomeInvalid = 'O sobrenome tem que ter entre 0 e 255 caracteres';
      }
    },
    validaEmail: function(){
      if (this.email.length > 0 && this.email.length < 255) {
        this.emailInvalid = false;
      }else {
        this.emailInvalid = 'O email tem que ter entre 0 e 255 caracteres';
      }
    },
    validaPassword: function(){
      if (this.password.length > 0 && this.password.length < 255) {
        this.passwordInvalid = false;
      }else {
        this.passwordInvalid = 'A senha tem que ter mais de 6 dígitos';
      }
    },
    postRegister: function(e){
      e.preventDefault();
      this.$http.post(
        'auth/register',
        {
          nome: this.nome,
          sobrenome: this.sobrenome,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        }
      ).success(function(data){
        if (data == true) {
          window.location="app";
        }else {
          console.log(data);
        }
      }).error(function(data){
        for (var err in  data){
          this.$set(err + 'Invalid', data[err]);
        }
      });
    }
  }
};
