<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('6883c49c6bc80e6506a0', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('sss');
    channel.bind('sss', function(data) {
      alert(JSON.stringify(data.id));
      $('me').text()+1;
    });
  </script>
</head>
<body>
<h1 id="me">1</h1>
<h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>status-liked</code>.
  </p>
</body>