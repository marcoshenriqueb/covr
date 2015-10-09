module.exports = {
  template: require('./painel.template.html'),

  data: function(){
    return {
      operation: '',
      currency: '',
      currencyFilter: '',
      amount: '',
      price: '',
      address: '',
      place_id: '',
      results: '',
      newBid: false,
      currentBids: false,
      bids: [],
      offers: [],
      availableCurrencies: [
        {text: 'Escolha...', value: ''}
      ],
      searchBid: '',
      newBidDisabled: false,
      operationError: false,
      currencyError: false,
      amountError: false,
      priceError: false,
      addressError: false,
      currentPagination: 1,
      loadMoreBids: true,
      friendBidFilter: false
    };
  },

  ready: function(){
    var that = this;
    $('#friendBidFilter').bootstrapSwitch();
    $('#friendBidFilter').on('switchChange.bootstrapSwitch', function(event,state){
        that.friendBidFilter = state;
        that.loadMoreBids = true;
        that.currentPagination = 1;
        that.getBids();
      });
    this.getAvailableCurrencies();

    this.getBids();
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
      map = new google.maps.Map(document.getElementById('map-new-bid'), {
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
      this.operationError = false;
      this.currencyError = false;
      this.amountError = false;
      this.priceError = false;
      this.addressError = false;
      var postData = {
        operation: this.operation,
        currency: this.currency,
        amount: this.amount,
        price: this.price,
        address: this.address,
        place_id: this.place_id,
      };
      this.$http.post('api/bid', postData)
      .success(function(data){
        this.getBids();
        this.operation = '';
        this.currency = '';
        this.amount = '';
        this.price = '';
        this.address = '';
        this.place_id = '';
        this.newBid = false;
      })
      .error(function(data){
        for(var k in data){
          this[k + 'Error'] = true;
          console.log(data[k]);
        }
      });
    },
    cancelNewBid: function(){
      this.newBid = false;
    },
    openNewBid: function(){
      if (this.newBid) {
        this.newBid = false;
      }else {
        this.newBid = true;
        this.currentBids = false;
        var that = this;
        var init = function rec (){
          var check = document.getElementById("map-new-bid");
          if (mapOk && check != null) {
            that.initMap();
          }else {
            setTimeout(function(){rec();},500);
          }
        }
        setTimeout(function(){init();},800);
      }
    },
    openCurrentBids: function(){
      if (this.currentBids) {
        this.currentBids = false;
      }else {
        this.newBid = false;
        this.currentBids = true;
      }
    },
    cancelBid: function(b){
      var id = b.id;
      this.$http.delete('api/bid/destroy', {id: id})
        .success(function(data){
          // this.bids.splice(index, 1);
          this.getBids();
        });
    },
    getBids: function(){
      this.offers = [];
      this.bids = [];
      var b = this.friendBidFilter ? 1 : 0;
      this.$http.get('api/bid/' + b, function(data){
        for(var key in data){
          this.bids.push(data[key].bid);
          for(var k in data[key].offers){
            this.offers.push(data[key].offers[k]);
          }
        }
        setTimeout(function(){
          $('.grid').masonry({
            // options
            itemSelector: '.grid-item'
          }, 50);
        })
      });
    },
    loadPagination: function(){
      this.loadMoreBids = false;
      var b = this.friendBidFilter ? 1 : 0;
      this.$http.get('api/bid/page/' + ++this.currentPagination + '/' + b, function(data){
        for(var key in data){
          // this.bids.push(data[key].bid);
          for(var k in data[key].offers){
            this.offers.push(data[key].offers[k]);
          }
          if (data[key].offers.length > 0) {
            this.loadMoreBids = true;
          }
        }
      });
    },
    openChat: function(o){
      this.$http.post('api/chat', o)
      .success(function(data){
        window.chatToGoUpId = data.id == undefined ? data[0].id : data.id;
        window.router.go({
          path: '/contatos'
        });
      })
      .error(function(data){
        console.log(data);
      });
    }
  }
};
