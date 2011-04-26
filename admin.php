<?php
if(file_exists("install.php"))
	header("Location: install.php");
?>
<html>
<head>
<title>~Admin</title>
<link type="text/css" href="themes/style.css" rel="stylesheet">
<link rel="shortcut icon" href="http://ideneal.hellospace.net/favicon.ico" type="image/x-icon">
</head>
<body>

<?php
include "class.Iden.php";
$iden = new Iden();

$cmd = htmlentities($_GET['cmd']);

if($iden->is_Admin()){
	switch($cmd){
		case 'write':
			$title = $_POST['title'];
			$content = $_POST['content'];
			if(!empty($title) && !empty($content)){
				$iden->setPage($title,$content);
				header ("Location: admin.php");
			}else{
				echo "<form action='admin.php?cmd=write' method='POST'>";
				echo "<input type='text' name='title'><br>";
				echo "<textarea cols='150' rows='20' name='content'></textarea><br>";
				echo "<input type='submit' value='Send'>";
				echo "</form>";
			}
			break;
		case 'edit':
			$title = $_GET['title'];
			if(!empty($title)){
				$content = $_POST['content'];
				if(!empty($content)){
					$iden->setPage($title, $content);
					header ("Location: admin.php");
				}else{
					echo "<form action='admin.php?cmd=edit&title={$title}' method='POST'>";
					echo $title;
					echo "<br><textarea cols='150' rows='20' name='content'>".$iden->getPage($title)."</textarea><br>";
					echo "<input type='submit' value='Send'>";
					echo "</form>";
				}
			}else{
				global $filepath;
				$dir = opendir($filepath);
				while( ($file = readdir($dir)) != false ){
					if(!is_dir($filepath."/".$file))
						echo "<a href='admin.php?cmd=edit&title=".$file."'>".$file."</a><br>";
				}
			}
			break;
		case 'delete':
			$title = $_GET['title'];
			if(!empty($title)){
				$iden->delPage($title);
				header("Location: admin.php");
			}else{
				global $filepath;
				$dir = opendir($filepath);
				while( ($file = readdir($dir)) != false ){
					if(!is_dir($filepath."/".$file))
						echo "<a href='admin.php?cmd=delete&title=".$file."'>".$file."</a><br>";
				}
			}
			break;
		case 'writecode':
			$title = $_POST['title'];
			$code = $_POST['content'];
			if(!empty($title) && !empty($code)){
				$iden->setCode($title,$code);
				header ("Location: admin.php");
			}else{
				echo "<form action='admin.php?cmd=writecode' method='POST'>";
				echo "<input type='text' name='title'><br>";
				echo "<textarea cols='150' rows='20' name='content'></textarea><br>";
				echo "<input type='submit' value='Send'>";
				echo "</form>";
			}
			break;
		case 'delcode':
			$title = $_GET['title'];
			if(!empty($title)){
				$iden->delCode($title);
				header("Location: admin.php");
			}else{
				global $codepath;
				$dir = opendir($codepath);
				while( ($file = readdir($dir)) != false ){
					if(!is_dir($codepath."/".$file))
						echo "<a href='admin.php?cmd=delcode&title=".$file."'>".$file."</a><br>";
				}
			}
			break;
		case 'editcode':
			$title = $_GET['title'];
			if(!empty($title)){
				$code = $_POST['content'];
				if(!empty($code)){
					$iden->setCode($title, $code);
					header ("Location: admin.php");
				}else{
					echo "<form action='admin.php?cmd=editcode&title={$title}' method='POST'>";
					echo $title;
					echo "<br><textarea cols='150' rows='20' name='content'>".$iden->getCode($title)."</textarea><br>";
					echo "<input type='submit' value='Send'>";
					echo "</form>";
				}
			}else{
				global $codepath;
				$dir = opendir($codepath);
				while( ($file = readdir($dir)) != false ){
					if(!is_dir($codepath."/".$file))
						echo "<a href='admin.php?cmd=editcode&title=".$file."'>".$file."</a><br>";
				}
			}
			break;
		default:
			echo "<a href='admin.php?cmd=edit'>Edit</a><br>";
			echo "<a href='admin.php?cmd=write'>Write</a><br>";
			echo "<a href='admin.php?cmd=delete'>Delete</a><br><br>";
			echo "<a href='admin.php?cmd=editcode'>Edit Code</a><br>";
			echo "<a href='admin.php?cmd=writecode'>Write Code</a><br>";
			echo "<a href='admin.php?cmd=delcode'>Delete Code</a><br><br>";
			echo "<a href='index.php'>Came back to Home</a><br>";
			
	}
}else{
	$usr = $_POST['user'];
	$pas = md5($_POST['pass']);
	if(!empty($usr) && !empty($pas)){
		setcookie ("uname",$usr);
		setcookie ("upass",$pas);
		header ("Location: admin.php");
	}else{
		echo "<form method='POST'>";
		echo "<input type='text' name='user'><br>";
		echo "<input type='password' name='pass'><br>";
		echo "<input type='submit' value='Send'>";
		echo "</form>";
	}
}
?>

</body>
</html>
