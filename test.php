<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
$(document).ready(function(){
	$.ajax({
	  url: "testmysql.php",
	})
  	.done(function( data ) {
	    alert(data);
	});
 });

</script>

</head>

<body>
The content of the document......

</body>

</html>


