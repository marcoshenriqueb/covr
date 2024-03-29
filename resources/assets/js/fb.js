// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
  // console.log(response);
  // The response object is returned with a status field that lets the
  // app know the current login status of the person.
  // Full docs on the response object can be found in the documentation
  // for FB.getLoginStatus().
  if (response.status === 'connected') {
    // Logged into your app and Facebook.
    FbGetAppSession();
  } else if (response.status === 'not_authorized') {
    // The person is logged into Facebook, but not your app.
    // FbLogin();
  } else {
    // The person is not logged into Facebook, so we're not sure if
    // they are logged into this app or not.
  }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

window.fbAsyncInit = function() {
FB.init({
  appId      : '1624162921159188',
  cookie     : true,  // enable cookies to allow the server to access
                      // the session
  xfbml      : true,  // parse social plugins on this page
  version    : 'v2.2' // use version 2.2
});

// Now that we've initialized the JavaScript SDK, we call
// FB.getLoginStatus().  This function gets the state of the
// person visiting this page and can return one of three states to
// the callback you provide.  They can be:
//
// 1. Logged into your app ('connected')
// 2. Logged into Facebook, but not your app ('not_authorized')
// 3. Not logged into Facebook and can't tell if they are logged into
//    your app or not.
//
// These three cases are handled in the callback function.



};

// Load the SDK asynchronously
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
var FbLogin = function() {
  FB.api('/me?fields=id,first_name,last_name,picture,location,age_range,email', function(response) {
    // console.log(JSON.stringify(response));

  });
  FB.api("/me/friendlists", function (response) {
    if (response && !response.error) {
      // console.log(JSON.stringify(response));
    }
  });
}

var FbGetAppSession = function() {
  FB.api('/me?fields=id,first_name,friends,last_name,picture,location,age_range,email', function(response) {
    var csrf = document.querySelector('#token').getAttribute('value');
    var dados = response;
    console.log(dados);
    jQuery.ajax({
      method: 'POST',
      url: "auth/FBlogin",
      headers: {
        'X-CSRF-TOKEN': csrf
      },
      data: {
        user: dados
      },
      dataType:"json",
      success: function(data){
        if (data) {
          FB.api('/me/picture?type=large', function(response) {
            var profilePic = response.data.url;
            jQuery.ajax({
              method: 'PUT',
              url: 'api/user/fbRegisterProfilePic',
              data: {
                profilePic: profilePic,
                email: dados.email
              },
              dataType: "json",
              success: function(data){
                if (data) {
                  window.location="app";
                }
              },
              error: function(data){
                // console.log('Deu erro 2.');
                // console.log(data);
              }
            });
          });
        }else {
          // console.log('Não passou.');
          // console.log(data);
        }
      },
      error: function(data){
        // var errors = data.responseJSON;
        // console.log('Deu erro.');
        // console.log(data);
      }
    });
  });
}
