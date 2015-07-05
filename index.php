<?php require("./php/controller.php"); ?>

<!doctype html>
<html ng-app>
<head>
<title>Mystery</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="./css/com.css" rel="stylesheet" type="text/css" >
<?php require("./php/theme.php")?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php require("./php/console.php")?>
<script src="http://mysterychat-jelec.c9.io/socket.io/socket.io.js"></script>
<script src="js/controller.js"></script>
</head>
<body ng-controller="ChatController">
<pre></pre>
<form>
    <div id="currentDirName"><?php echo "Dark Room - " ?></div>
    <div>&nbsp;<font color="red"><?php echo "Hero" ?>$&nbsp;</font></div>
    <div id="command"><input type="text" value=""></div>
</form>
</body>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/angular.min.js"></script>
</html>