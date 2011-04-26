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

<?php
include "class.Iden.php";

$iden = new Iden();
echo "<center>\n";
$iden->create_Menu();
echo "</center> \n";

$title = $_GET['title'];

if(empty($title)){
	die("Page Not Found \n If there are another problems please contact the Admin");
}else{
	$iden->showCode($title);
}
?>
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
