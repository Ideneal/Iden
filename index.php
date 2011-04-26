<?php
if(file_exists("install.php"))
	header("Location: install.php");
?>
<html>
<head>
<title>~Iden</title>
<link type="text/css" href="themes/style.css" rel="stylesheet">
<link rel="shortcut icon" href="http://ideneal.hellospace.net/favicon.ico" type="image/x-icon">
</head>
<body>
<center>

<?php
include "class.Iden.php";

$iden = new Iden();
$iden->create_Menu();

if (!isset($_GET['page']))
	$iden->showPage("Home");
else
	$iden->showPage($_GET['page']);


?>
</center>
<div align="right">
<font color="#282828">
<pre>
__________________________  
< Iden CMS >                
--------------------------  
        \   ^__^            
         \  (oo)\_______    
            (__)\       )\/\
                ||----w |   
                ||     ||   
</pre>
</font>
</div>
</body>
</html>
