module.exports = {
  template: require('./contatos.template.html'),

  data: function(){
    return {
      friends: {},
      notFriends: {},
      requests: {},
      requested: {},
      friendsCount: 0,
      searchBar: '',
      searchFriends: '',
      selectedFriend: ''
    };
  },

  computed: {

  },

  filters: {
    dontShow: function(value){
      if (this.searchBar == '') {
        return [];
      }
      return value;
    }
  },

  ready: function(){
    this.$http.get('api/friends/get', function(data){
      this.friends = data.friends;
      this.requests = data.requests;
      this.requested = data.requested;
      this.friendsCount = data.friends.length;
    })
  },

  methods: {
    requestFriend: function(n, e){
      this.$http.post('api/friends/request', {id: n.id}, function(data){
        e.target.disabled = true;
      }).success(function(){
        this.requests.push(n);
      })
    },
    confirmFriend: function(r, e, i){
      this.$http.post('api/friends/confirm', {id: r.id}, function(data){
        e.target.disabled = true;
      }).success(function(){
        this.friends.push(r);
        this.requested.splice(i, 1);
      })
    },
    removeRequested: function(r, e, i){
      this.$http.post('api/friends/removeRequest', {id: r.id}, function(data){
        e.target.disabled = true;
      }).success(function(){
        this.requested.splice(i, 1);
      })
    },
    cancelRequest: function(r, e, i){
      this.$http.post('api/friends/cancelRequest', {id: r.id}, function(data){
        e.target.disabled = true;
      }).success(function(){
        this.requests.splice(i, 1);
      })
    },
    getNotFriends: function(){
      if (this.searchFriends.length >= 3) {

        this.$http.get('api/friends/search/' + this.searchFriends, function(data){
          this.notFriends = data;
        })
      }
    }
  }
}
