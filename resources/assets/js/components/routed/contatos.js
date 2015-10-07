module.exports = {
  template: require('./contatos.template.html'),

  data: function(){
    return {
      user: {},
      friends: {},
      notFriends: {},
      requests: {},
      requested: {},
      friendsCount: 0,
      searchBar: '',
      searchFriends: '',
      availableChats: [],
      currentChat: null,
      messageInput: '',
      messagePagination: 1,
      loadMore: true
    };
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
    });
    this.$http.get('api/chat', function(data){
      this.availableChats = data;
    }).success(function(){
      if (window.chatToGoUpId != undefined) {
        this.takeChatUp(window.chatToGoUpId);
        window.chatToGoUpId = undefined;
        this.openChat(0);
      }
    });
    this.$http.get('api/user', function(data){
      this.user = data;
    });
    var that = this;
    window.socket.on('chat-message:App\\Events\\BroadcastChatMessage', function(data){
      if (that.currentChat != null && data.message.chat_id == that.currentChat.id) {
        that.currentChat.messages.push({
          message: data.message.message,
          created_at: data.message.created_at,
          user_id: data.message.user_id,
          chat_id: data.message.chat_id
        });
        var box = document.getElementById("chat-scroll");
        setTimeout(function(){box.scrollTop = box.scrollHeight;}, 10);
      }else {
        for(var k in that.availableChats){
          if (data.message.chat_id == that.availableChats[k].id) {
            that.availableChats[k].countNotRead++;
          }
        }
      }
      that.takeChatUp(data.message.chat_id);
    });
    window.socket.on('deleted-chats:App\\Events\\ChatHasBeenDeleted', function(data){
      console.log(data);
      if (that.currentChat != null && data.chat_id == that.currentChat.id) {
        $('#deletedChatModal').modal('show');
        that.currentChat = null;
      }
      for(var k in that.availableChats){
        if (data.chat_id == that.availableChats[k].id) {
          that.availableChats.splice(k, 1);
        }
      }
    });
    window.socket.on('created-chats:App\\Events\\ChatHasBeenCreated', function(data){
      console.log(data);
      that.availableChats.unshift(data.chat);
    });
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
    },
    openChat: function(index){
      this.loadMore = true;
      var that = this;
      this.$http.get('api/message/' + this.availableChats[index].id)
        .success(function(data){
          that.currentChat = that.availableChats[index];
          that.currentChat.messages = data;
          setTimeout(function(){
            var box = document.getElementById("chat-scroll");
            box.scrollTop = box.scrollHeight;
          }, 10);
          that.$http.put('api/message/read', that.currentChat)
            .success(function(){
              that.availableChats[index].countNotRead = 0;
            })
            .error(function(data){
              console.log(data);
            });
        })
        .error(function(data){
          console.log(data);
        });
    },
    loadMoreMessages: function(){
      var that = this;
      this.$http.get('api/message/' + this.currentChat.id + '/' + ++this.messagePagination)
        .success(function(data){
          // this.currentChat.messages = data.concat(this.currentChat.messages);
          var l = data.length - 1;
          for(var k in data){
            this.currentChat.messages.unshift(data[l - k]);
          }
          if (data.length == 0) {
            this.loadMore = false;
          }
        })
        .error(function(data){
          console.log(data);
        });
    },
    closeChat: function(){
      this.currentChat = null;
      this.messagePagination = 1;
    },
    sendMessage: function(){
      if (this.messageInput.trim() != '') {
        var userTo = (this.user.id == this.currentChat.user_1) ? this.currentChat.user_2 : this.currentChat.user_1;
        var postData = {
          message: this.messageInput,
          user_id: this.user.id,
          chat_id: this.currentChat.id,
          userTo: userTo
        };
        this.$http.post('api/message/store', postData)
          .success(function(data){
            this.currentChat.messages.push({
              message: this.messageInput,
              created_at: window.moment().format('YYYY-MM-DD H:mm:ss'),
              user_id: this.user.id,
              chat_id: this.currentChat.id,
              user: this.user
            });
            this.messageInput = '';
            this.takeChatUp(this.currentChat.id);
            var box = document.getElementById("chat-scroll");
            setTimeout(function(){box.scrollTop = box.scrollHeight;}, 10);
          })
          .error(function(data){
            console.log(data);
          });
      }
    },
    takeChatUp: function(id){
      for(var k in this.availableChats){
        if (id == this.availableChats[k].id) {
          var hold = this.availableChats[k];
          this.availableChats.splice(k, 1);
          this.availableChats.unshift(hold);
        }
      }
    },
    destroyChat: function(){
      var id = this.currentChat.id;
      this.$http.delete('api/chat/' + id)
        .success(function(data){
          console.log(data);
          $('#myModal').modal('hide');
          for(var k in this.availableChats){
            if (this.availableChats[k].id == id) {
              this.availableChats.splice(k, 1);
            }
          }
          this.currentChat = null;
        })
        .error(function(data){
          console.log(data);
        });
    }
  }
}
