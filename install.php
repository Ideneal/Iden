<?php

if (isset($_POST['pass']) && isset($_POST['user']) && isset($_POST['filepath']) && isset($_POST['codepath'])){
	mkdir($_POST['filepath']);
	mkdir($_POST['codepath']);
	
	$settings = '<?php
		$filepath = "'.addslashes($_POST['filepath']).'";
		$codepath = "'.addslashes($_POST['codepath']).'";
		$username = "'.addslashes($_POST['user']).'";
		$password = md5("'.stripslashes($_POST['pass']).'");
		?>';
	$fd = fopen("settings.php", "w");
	fwrite($fd,$settings);
	fclose($fd);
	
	$home = "<p>Hello welcome to Iden CMS :D
		This is home page and you can modify it if you go <a href='admin.php'>here</a>
		I hope you'll enjoy :D</p>";
	$fd = fopen($_POST['filepath']."/Home" , "w");
	fwrite($fd , $home);
	fclose($fd);
	
	$code = "<start>
	here you can put
	all type of code
	Do you like indentation? ;)
</start>
";
	$fd = fopen($_POST['codepath']."/source" , "w");
	fwrite($fd , $code);
	fclose($fd);
	
	$source = "<p>This is an example source
	<a href='reader.php?title=source'>source</a></p>";
	$fd = fopen($_POST['filepath']."/Sources" , "w");
	fwrite($fd , $source);
	fclose($fd);
	
	unlink("install.php");
	header("Location: index.php");
}else{
	echo "<form method='POST'>\n";
	echo "Pages_path: <input type='text' value='Iden' name='filepath'><br>\n";
	echo "Source_path: <input type='text' value='Code' name='codepath'><br>\n";
	echo "User: <input type='text' name='user'><br>\n";
	echo "Pass: <input type='password' name=\"pass\"><br>\n";
	echo "<input type='submit' value='Install'>\n";
	echo "</form>";
}
?>
