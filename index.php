<?php require("./php/controller.php"); ?>

<!doctype html>
<html>
<head>
<title>Mystery</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="./css/com.css" rel="stylesheet" type="text/css" >
<?php require("./php/theme.php")?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php require("./php/console.php")?>
<script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
</head>
<body>
<pre></pre>
<form>
    <div id="currentDirName"><?php echo "Hello" ?></div>
    <div>&nbsp;<?php echo "Hero" ?>$&nbsp;</div>
    <div id="command"><input type="text" value=""></div>
</form>
</body>
</html>