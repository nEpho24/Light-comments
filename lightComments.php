<?php 

/** 
 * @author nEpho24 (iiigameriii24@gmail.com)
 * It's a file (lightComments.php) that you have to add , then you 
 * put one command and you have a comment section
 */

/**
 * HOW IT WORKS :
 * 		step 1 - change $config value (put your own informations)
 *		step 2 - include this file in the page where you want to show the comment form
 *		step 3 - write : LightCom::init(## HERE YOU PUT THE COMMENT ID ##);
 *
 *		====================================================================
 *
 *		step 4 (optional) - You can change the style of the form ;)
 */

class LightCom{

	public static $config = array(
			"host"			=>	"localhost",
			"db_name"		=>	"test",
			"username"		=>	"root",
			"password"		=>	"",
			"table_name"	=>	"light_comments"
		);

	public function init($commentId){
		self::form();
		self::inputListener($commentId);
	}

	/**
	 * Shows the form
	 */
	public static function form(){
		echo '<form method="POST">';
			echo '<textarea name="light-comments-content" id="light-comments-content" style="width:100%;height:70px;" ></textarea>';
			echo '<input type="submit" name="validation" />';
		echo '</form>';
	}


	/**
	 * Wait for the comment to be submited and then asks the core() function to do it's work
	 */
	public static function inputListener($commentId){
		if(isset($_POST["light-comments-content"])){
			$commentContent = htmlentities(addslashes($_POST["light-comments-content"]));
			self::addToDB($commentId,$commentContent); 
		}
	}


	/**
	 * Add a new comment in the database
	 */
	public static function addToDB($postId,$commentContent){
		$table = self::$config["table_name"];
		$host = self::$config["host"];
		$dbName = self::$config["db_name"];
		$username = self::$config["username"];
		$password = self::$config["password"];
		$postId = htmlentities(addslashes($postId));
		$content = htmlentities(addslashes($commentContent));


		$connect = new PDO('mysql:host='.$host.';dbname='.$dbName.'',$username,$password);

		$connect->query("INSERT INTO ".$table." (post_id,content) values('$postId','$content') ");
	}

}

?>
