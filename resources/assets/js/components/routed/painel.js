module.exports = {
  template: require('./painel.template.html'),

  data: function(){
    return {
      operation: '',
      currency: '',
      amount: '',
      price: '',
      address: '',
      place_id: '',
      results: '',
      availableCurrencies: []
    };
  },

  ready: function(){
    var that = this;
    var init = function rec (){
      if (mapOk) {
        that.initMap();
      }else {
        setTimeout(function(){rec();},500);
      }
    }
    init();
    this.getAvailableCurrencies();
  },

  methods: {
    findGeolocation: function(){
      var that = this;
      if (this.address.length > 3) {
        geocoder.geocode( { 'address': this.address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            that.place_id = results[0].geometry.location;
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      }
    },
    reverseGeolocation: function(latlng){
      var that = this;
      geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            map.setZoom(11);
            var marker = new google.maps.Marker({
              position: latlng,
              map: map
            });
            that.address = results[1].formatted_address;
            infowindow.setContent(results[1].formatted_address);
            infowindow.open(map, marker);
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
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -22.998657, lng: -43.398863},
        zoom: 12
      });

      geocoder = new google.maps.Geocoder();
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
    getAvailableCurrencies: function(){
      this.$http.get('api/currency/available', function(data){
        for (var k in data){
          var set = {text:data[k]['currency'], value:data[k]['ticker']};
          this.availableCurrencies.push(set);
        }
      })
    },
    postBid: function(){
      var postData = {
        operation: this.operation,
        currency: this.currency,
        amount: this.amount,
        price: this.price,
        address: this.address,
        place_id: this.place_id,
      }
      this.$http.post('api/bid/store', postData, function(data){
        console.log(data);
      });
    }
  }
};
