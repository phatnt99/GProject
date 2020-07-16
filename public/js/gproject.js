$(document).ready(function() {
  var pusher = new Pusher('419f519367020011ddd5', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('user-channel');
  channel.bind('user-created', function(data) {
    console.log(data);
    $('.notify-content').text('New user ' + data.notify + ' has registered!');
    $('.toast').toast('show');
  });

  channel.bind('user-online', function(data) {
    console.log(data);
    $('.notify-content').text('User ' + data.notify + ' is online!');
    $('.toast').toast('show');
  });

});
