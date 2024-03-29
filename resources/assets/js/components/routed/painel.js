module.exports = {
  template: require('./painel.template.html'),

  data: function(){
    return {
      operation: '',
      currency: '',
      currencyFilter: '',
      amount: '',
      price: '',
      deadline: '',
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
      deadlineError: false,
      addressError: false,
      currentPagination: 1,
      loadMoreBids: true,
      friendBidFilter: false,
      radius: 50,
      bidOrder: 'amount_difference',
      showFilters: false
    };
  },

  ready: function(){

    this.getAvailableCurrencies();

    this.getBids();
  },

  filters: {
    toFixed: function(value, n){
      return Number(value).toFixed(n);
    }
  },

  methods: {
    findGeolocation: function(){
      var that = this;
      if (this.address.length > 3) {
        geocoder.geocode( { 'address': this.address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
            that.setPlaceId(results);
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
      this.deadlineError = false;
      var postData = {
        operation: this.operation,
        currency: this.currency,
        amount: this.amount,
        price: this.price,
        address: this.address,
        place_id: this.place_id,
        deadline: this.deadline
      };
      this.$http.post('api/bid', postData)
      .success(function(data){
        this.getBids();
        this.operation = '';
        this.currency = '';
        this.amount = '';
        this.price = '';
        this.deadline = '';
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
            $('.datepicker').datepicker({
              format: 'dd/mm/yyyy',
              autoclose: true,
              disableTouchKeyboard: true,
              language: 'pt-BR',
              clearBtn: true,
              startDate: window.moment().format('DD-MM-YYYY'),
              todayHighlight: true
            });
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
      this.showFilters = false;
      this.loadMoreBids = true;
      this.currentPagination = 1;
      this.offers = [];
      this.bids = [];
      var b = this.friendBidFilter ? 1 : 0;
      var c = this.radius > 0 ? this.radius : 50;
      var d = this.bidOrder;
      this.$http.get('api/bid/' + b + '/' + c + '/' + d, function(data){
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
      var c = this.radius > 0 ? this.radius : 50;
      var d = this.bidOrder;
      this.$http.get('api/bid/page/' + ++this.currentPagination + '/' + b + '/' + c + '/' + d, function(data){
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
    },
    setPlaceId: function(geometry){
      console.log(geometry[0]['geometry']['location'].lat());
      this.place_id = {
        H: geometry[0]['geometry']['location'].lat(),
        L: geometry[0]['geometry']['location'].lng()
      };
    },
    openFilters: function(){
      this.showFilters = !this.showFilters;
      if (this.showFilters) {
        var that = this;
        var initRec = function rec(){
          var $bsSwitch = $('#friendBidFilter');
          if ($bsSwitch.length > 0) {
            $bsSwitch.bootstrapSwitch()
            $bsSwitch.on('switchChange.bootstrapSwitch', function(event,state){
                that.friendBidFilter = state;
              });
          }else {
            setTimeout(function(){
              rec();
            }, 50);
          }
        }
        initRec();
      }
    }
  }
};
