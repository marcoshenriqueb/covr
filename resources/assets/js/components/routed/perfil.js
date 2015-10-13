module.exports = {
  template: require('./perfil.template.html'),

  data: function(){
    return {
      currentClick: '',
      nome: '',
      sobrenome: '',
      localizacao: '',
      place_id: '',
      profile_pic: '',
      readyData: {},
      erros: false,
      readyOk: false
    };
  },

  ready: function(){
    this.$http.get('api/user', function(data){
      this.profile_pic = data.profile_pic;
      this.nome = data.nome;
      this.sobrenome = data.sobrenome;
      this.localizacao = data.localizacao;
      this.place_id = JSON.parse(data.place_id);
      this.readyData = data;
      this.readyOk = true;
    })
    var that = this;
    var init = function rec (){
      if (mapOk && that.readyOk) {
        that.initMap();
      }else {
        setTimeout(function(){rec();},500);
      }
    }
    init();
    var dropzoneProfile = new window.Drop("form#dropzone-demo", {
      url: 'api/user/profilePicDrop',
      parallelUploads: 1,
      maxFilesize: 5,
      paramName: 'profilePic',
      headers: {'Authorization': 'Bearer ' + document.querySelector('#token').getAttribute('value')},
      acceptedFiles: '.jpg, .jpeg, .png, .bmp, .gif, .svg',
      dictDefaultMessage: 'Arraste a sua foto para cá!',
      dictInvalidFileType: 'Favor colocar uma imagem',
      dictFileTooBig: 'A imagem é muito grande',
      dictResponseError: 'Erro ao fazer upload',
      dictMaxFilesExceeded: 'Excedido o número de uploads permitidos',
      success: function(data, response){
        response = JSON.parse(response);
        that.profile_pic = response.profile_pic;
      }
    });
  },

  methods: {
    findGeolocation: function(){
      if (this.localizacao.length > 3) {
        this.erros = false;
        var that = this;
        geocoderPerfil.geocode( { 'address': this.localizacao}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {

            that.place_id = results[0].geometry.location;
            mapPerfil.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: mapPerfil,
                position: results[0].geometry.location
            });
            that.postEditarLocation();
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      }else {
        this.erros = 'Você precisa digitar um local.'
      }
    },
    reverseGeolocation: function(latlng){
      var that = this;
      geocoderPerfil.geocode({'location': latlng}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            mapPerfil.setZoom(11);
            var marker = new google.maps.Marker({
              position: latlng,
              map: mapPerfil
            });
            that.localizacao = results[1].formatted_address;
            infowindow.setContent(results[1].formatted_address);
            infowindow.open(mapPerfil, marker);
          } else {
            window.alert('Não tivemos resultados');
          }
        } else {
          window.alert('Geocoder falhou por causa de: ' + status);
        }
      });
    },
    initMap: function(){
      infowindow = new google.maps.InfoWindow;
      mapPerfil = new google.maps.Map(document.getElementById('map'), {
        center: {lat: this.place_id ? this.place_id.H : -22.975782, lng: this.place_id ? this.place_id.L : -43.212179},
        zoom: 12
      });

      geocoderPerfil = new google.maps.Geocoder();
    },
    editar: function(e){
      if (this.currentClick.length > 0) {
        this.erros = false;
        this[this.currentClick] = this.readyData[this.currentClick];
      }
      this.currentClick = e.target.id;
    },
    cancel: function(){
      this[this.currentClick] = this.readyData[this.currentClick];
      this.currentClick = '';
      this.erros = false;
    },
    postEditar: function(campo){
      var putData = {};
      putData[campo] = this[this.currentClick];
      this.$http.put('api/user/' + campo, putData, function(data){
        this.readyData = data;
        this.currentClick = '';
        this.erros = false;
      }).error(function(data){
        this.erros = data[campo][0];
      });
    },
    postEditarLocation: function(){
      var putData = {
        localizacao: this.localizacao,
        place_id: this.place_id
      };
      this.$http.put('api/user/localizacao', putData, function(data){
        this.readyData = data;
        this.currentClick = '';
        this.erros = false;
      }).error(function(data){
        this.erros = data[localizacao][0];
      });
    },
    nullLocation: function(){
      this.localizacao = null;
      this.place_id = null;
      var putData = {
        localizacao: this.localizacao,
        place_id: this.place_id
      };
      this.$http.put('api/user/localizacao', putData, function(data){
        this.readyData = data;
        this.currentClick = '';
        this.erros = false;
      }).error(function(data){
        this.erros = data[localizacao][0];
      });
    },
    findCurrentLocation: function(){
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.saveCurrentPosition);
      } else {
        alert("Não conseguimos achar a sua localização.");
      }
    },
    saveCurrentPosition: function (position){
      this.place_id = {
        H: position.coords.latitude,
        L: position.coords.longitude
      };
      this.reverseGeolocation({
        lat: position.coords.latitude,
        lng: position.coords.longitude
      });
    },
    destroyAccount: function(){
      this.$http.delete('api/user', function(){
        window.location.href = "auth/logout";
      });
    },
    openModal(modal){
      $(modal).modal();
    }
  }
};
