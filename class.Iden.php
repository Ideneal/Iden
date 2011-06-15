<?php
include "settings.php";

class Iden{
	var $uname, $upass, $file_path, $code_path;
	
	public function __construct(){
		global $username , $password, $filepath, $codepath;
		$this->uname = $username;
		$this->upass = $password;
		$this->file_path = $filepath;
		$this->code_path = $codepath;
	}
	
	private function setlines ($source)
	{
		$ex = explode ("\n" , $source);
		$ci = count ($ex);
		$c = 1;
		while ($c < $ci)
		{
			if (($c - 1) % 2 == 0)
				$ex [$c - 1] = "<span class='code'>" . $c . ".</span> ";
			else
			{
				if ($c % 10 == 0 && $c != 1)
					$ex [$c - 1] = "<b>" . $c . "</b>. ";
				else
					$ex [$c - 1] = $c . ". ";
			}
			$c++;
		}
		return implode ("\n" , $ex);
	}

	
	private function securityString($word){
		$word=str_replace("../","",$word);
		$word=str_replace(".","_",$word);
		$word=str_replace("/","",$word);
		$word = stripslashes(htmlentities($word));
		return $word;
	}
	
	public function is_Admin(){
		if($_COOKIE['uname'] && $_COOKIE['upass'])
			return ($this->uname == $_COOKIE['uname'] && $this->upass == $_COOKIE['upass']);
		else
			return false;
	}
	
	public function create_Menu(){
		$menu = array();
		$dir = opendir($this->file_path);
		while( ($file = readdir($dir)) != false ){
			if(!is_dir($this->file_path."/".$file))
				array_push($menu, $file);
		}
		//sort($menu);
		
		echo "<div>\n";
		echo "<span class=\"menu\">\n";
		$n = 0;
		foreach($menu as $page) {
			$n++;
			if ($n == count($menu)) { 
				echo "<a href=\"index.php?page=".htmlentities($page)."\" >".htmlentities($page)."</a>";
			} else {
				echo "<a href=\"index.php?page=".htmlentities($page)."\" >".htmlentities($page)."</a> - ";
			}
		}
		echo "</span></div><br />";
	}
	
	public function getPage($page){
		$page = $this->securityString($page);
		if(file_exists($this->file_path ."/". $page) && !is_dir($this->file_path."/".$page)){
			$fd = fopen($this->file_path ."/".$page, "r");
			$read = fread($fd, filesize($this->file_path . "/". $page));
			return stripslashes($read);
		}else{
			die("Page Not Found <br> If there are another problems please contact the Admin");
		}
	}
	
	public function setPage($title, $content){
		$fd = fopen($this->file_path ."/".$title, "w");
		fwrite($fd, $content);
		fclose($fd);
	}
	
	public function delPage($title){
		if(file_exists($this->file_path ."/".$title) && !is_dir($this->file_path ."/".$title))
			unlink($this->file_path ."/".$title);
	}
	
	public function showPage($title){
		$read = "<div class='main' >\n"
		. nl2br($this->getPage($title))
		. "</div><br><div class='footer'>Powered by <a href='http://www.ideneal.hellospace.net/'>Iden</a></div>";
		echo $read;
	}
	
	public function showCode($title){
		$read = $this->getCode($title);
		echo "<table> <tr>";
		echo "<td><pre>" .$this->setlines($read). "</pre></td>";
		echo "<td><pre>" .$read. "</pre></td></tr></table>";
		echo "<br><br><br><div>Powered by <a href='http://www.ideneal.hellospace.net/'>Iden</a></div>";
	}
	
	public function setCode($title, $code){
		$fd = fopen($this->code_path ."/".$this->securityString($title), "w");
		fwrite($fd, $code);
		fclose($fd);
	}
	
	public function delCode($title){
		$title = $this->securityString($title);
		if(file_exists($this->code_path ."/".$title) && !is_dir($this->code_path ."/".$title))
			unlink($this->code_path ."/".$title);
	}
	
	public function getCode($title){
		$title = $this->securityString($title);
		if(file_exists($this->code_path."/".$title) && !is_dir($this->code_path."/".$title)){
			$file = fopen($this->code_path."/".$title, "r");
			$read = fread($file, filesize($this->code_path."/".$title));
			return stripslashes(htmlentities($read));
		}else{
			die("Page Not Found \n If there are another problems please contact the Admin");
		}
	}
}
?>