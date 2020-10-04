<form method="post" action="form.php">
Name : <input type="text" name="user_name" placeholder="Enter Your Name" /><br />
Email : <input type="email" name="user_email" placeholder="Enter Your Email" /><br />
Message : <textarea name="user_text"></textarea><br />
<input type="submit" value="Submit" />
</form>

<?php
//process.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form
	$u_name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$u_email = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
    $u_text = filter_var($_POST["user_text"], FILTER_SANITIZE_STRING);

    if (empty($u_name)){
		die("Please enter your name");
	}
	if (empty($u_email) || !filter_var($u_email, FILTER_VALIDATE_EMAIL)){
		die("Please enter valid email address");
	}
		
	if (empty($u_text)){
		die("Please enter text");
	}
	
	//print output text
	print "Hola " . $u_name . "!, hemos resivido tu mensaje, se esta procesando tu petición ". $u_email."<br><br>";
    
    //mysql credentials
	$mysql_host = "192.168.33.10";
	$mysql_username = "user";
	$mysql_password = "password";
    $mysql_database = "test";
  
    //Open a new connection to the MySQL server
	//see https://www.sanwebe.com/2013/03/basic-php-mysqli-usage for more info
    $mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
   
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
    
    $statement = $mysqli->prepare("INSERT INTO users (user_name, user_email, user_message) VALUES(?, ?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('sss', $u_name, $u_email, $u_text); //bind values and execute insert query

	if($statement->execute()){
		print "Hola " . $u_name . "!, tu mensaje ha sido guardado!";
	}else{
		print $mysqli->error; //show mysql error if any
	}


}
?>