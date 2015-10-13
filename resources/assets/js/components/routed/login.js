module.exports = {
  template: require('./login.template.html'),

  data: function(){
    return {
      email: '',
      password: '',
      authErr: false,
      remember: null,
      emailInvalid: false,
      passwordInvalid: false
    };
  },

  ready: function(){
    Ladda.bind( 'ladda-button' );
  },


  methods: {
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
    fbLogin: function(e){
      var l = Ladda.create(e.target);
      l.start();
      FB.login(function(response){
        // console.log(JSON.stringify(response));
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }, {scope: "public_profile,email,user_friends,user_location"});
    },
    postLogin: function(e){
      e.preventDefault();
      var l = Ladda.create(e.target);
      l.start();
      this.$http.post(
        'auth/login',
        {
          email: this.email,
          password: this.password,
          remember: this.remember
        }
      ).success(function(data){
        window.location="app";
        l.stop();
      }).error(function(data){
        l.stop();
        for (var err in  data){
          this.$set(err + 'Invalid', data[err]);
        }
        console.log(data);
      });
    }
  }
};
