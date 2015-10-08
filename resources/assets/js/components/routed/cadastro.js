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
      passwordInvalid: false,
      confirmationInvalid: false,
      emailExists: false
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
      var l = Ladda.create(e.target);
      l.start();
      this.nomeInvalid = false;
      this.sobrenomeInvalid = false;
      this.emailInvalid = false;
      this.passwordInvalid = false;
      this.confirmationInvalid = false;
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
          window.location="confirma-email";
        }else {
          console.log(data);
        }
      }).error(function(data){
        l.stop();
        for (var err in  data){
          if (data[err][0] == "A confirmação para o campo password não coincide.") {
            console.log(data[err][0]);
            this.$set('confirmationInvalid', data[err]);
          }else if (data[err][0] == "O valor indicado para o campo email já se encontra utilizado.") {
            this.emailExists = true;
            this.$set(err + 'Invalid', data[err]);
          }else {
            this.$set(err + 'Invalid', data[err]);
          }
        }
      });
    },
    fbLogin: function(e){
      var l = Ladda.create(e.target);
      l.start();
      FB.login(function(response){
        // console.log(JSON.stringify(response));
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }, {scope: "public_profile,email,user_friends,user_location"});
    }
  }
};
