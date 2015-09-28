module.exports = {
  template: require('./login.template.html'),

  data: function(){
    return {
      email: '',
      password: '',
      authErr: false
    };
  },


  methods: {
    fbLogin: function(){
      FB.login(function(response){
        // console.log(JSON.stringify(response));
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }, {scope: "public_profile,email,user_friends,user_location"});
    },
    postLogin: function(e){
      e.preventDefault();
      this.$http.post(
        'auth/login',
        {
          email: this.email,
          password: this.password
        }
      ).success(function(data){
        if (data == true) {
          window.location="app";
        }else {
          this.authErr = true;
        }
      }).error(function(data){
        console.log(data);
      });
    }
  }
};
