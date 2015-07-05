  
  function addMessage(msg){
    var screen = $('pre');
    var input = $('input').focus();
    var form = $('form');
    var scroll = function () {
        window.scrollTo(0, document.body.scrollHeight);
    };
     
     screen.append(msg);
     form.show();
     scroll(); 
  }
  
  
  function ChatController($scope) {
    var socket = io.connect('http://mysterychat-jelec.c9.io/');
    window.socket = socket;

    $scope.messages = [];
    $scope.roster = [];
    $scope.name = 'hero';
    $scope.text = '';

    socket.on('connect', function () {
      $scope.setName();
    });

    socket.on('message', function (msg) {
      $scope.messages.push(msg);
      addMessage("<font color='red'>" + msg.name + "</font> " + ": " + msg.text + "<br>");
      console.log(msg);
      $scope.$apply();
    });

    socket.on('roster', function (names) {
      $scope.roster = names;
      $scope.$apply();
    });

    $scope.send = function send() {
      console.log('Sending message:', $scope.text);
      socket.emit('message', $scope.text);
      $scope.text = '';
    };

    $scope.setName = function setName() {
      socket.emit('identify', $scope.name);
    };
  }