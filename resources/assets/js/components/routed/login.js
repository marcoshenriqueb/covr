module.exports = {
  template: require('./login.template.html'),

  data: function(){
    return {
      email: '',
      password: '',
      authErr: false,
      fbLoading: false,
      loading: false,
      remember: null
    };
  },


  methods: {
    fbLogin: function(){
      this.fbLoading = true;
      FB.login(function(response){
        // console.log(JSON.stringify(response));
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }, {scope: "public_profile,email,user_friends,user_location"});
    },
    postLogin: function(e){
      this.loading = true;
      e.preventDefault();
      this.$http.post(
        'auth/login',
        {
          email: this.email,
          password: this.password,
          remember: this.remember
        }
      ).success(function(data){
        if (data == true) {
          window.location="app";
        }else {
          this.loading = false;
          this.authErr = true;
        }
      }).error(function(data){
        this.loading = false;
        console.log(data);
      });
    }
  }
};
