<?php
session_start();

include 'parameters.php';

$uam_secret = "ht2eb8ej6s4et3rg1ulp";

function encode_password($plain, $challenge, $secret) {
  if ((strlen($challenge) % 2) != 0 ||
  strlen($challenge) == 0)
  return FALSE;
  
  $hexchall = hex2bin($challenge);
  if ($hexchall === FALSE)
  return FALSE;
  
  if (strlen($secret) > 0) {
    $crypt_secret = md5($hexchall . $secret, TRUE);
    $len_secret = 16;
  } else {
    $crypt_secret = $hexchall;
    $len_secret = strlen($hexchall);
  }
  
  /* simulate C style \0 terminated string */
  $plain .= "\x00";
  $crypted = '';
  for ($i = 0; $i < strlen($plain); $i++)
  $crypted .= $plain[$i] ^ $crypt_secret[$i % $len_secret];
  
  $extra_bytes = 0;//rand(0, 16);
  for ($i = 0; $i < $extra_bytes; $i++)
  $crypted .= chr(rand(0, 255));
  
  return bin2hex($crypted);
}

if(isset($_POST["userurl"])) {
  $_SESSION["userurl"] = $_POST["userurl"];
} else {
  unset($_SESSION["userurl"]);
}

$name=$_POST['name'];
$email=$_POST['email'];
$newsletter = 'Yes';

$username = $_SESSION["username"];
$password = $_SESSION["password"];
$uamip = $_SESSION["uamip"];
$uamport = $_SESSION["uamport"];
$challenge = $_SESSION["challenge"];

$encoded_password = encode_password($password, $challenge, $uam_secret);

$redirect_url = "http://$uamip:$uamport/logon?" .
"username=" . urlencode($username) .
"&password=" . urlencode($encoded_password);

# point them toward a different landing page if you want ...
# (couldn't get this working)
#$redirect_url .= "&redir=" . urlencode("http://www.nytimes.com");

session_write_close();

// $con=mysqli_connect("localhost","root","l2^e90fmMUNquD","users");

// if (mysqli_connect_errno()) {
//   echo "Failed to connect to SQL: " . mysqli_connect_error();
// }

// $date = date('d-m-Y');
// $time = date('H:i:s');

// mysqli_query($con, "
// CREATE TABLE IF NOT EXISTS `$sitename` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `MAC` varchar(45) NOT NULL,
//   `IP` varchar(45) NOT NULL,
//   `Name` varchar(45) NOT NULL,
//   `Email` varchar(45) NOT NULL,
//   `Newsletter` varchar(45) NOT NULL,
//   `Method` varchar(45) NOT NULL,
//   `Date` varchar(45) NOT NULL,
//   `Time` varchar(45) NOT NULL,
//   PRIMARY KEY (`id`),
//   UNIQUE KEY `id_UNIQUE` (`id`)
//   )");
  
//   mysqli_query($con,"INSERT INTO $sitename (MAC, IP, Name, Email, Newsletter, Method, Date, Time) VALUES ('$_SESSION[mac]', '$_SESSION[ip]', '$name', '$email', '$newsletter', '$method', '$date', '$time')");
  
//   mysqli_close($con);
  

    header('Location: ' . $redirect_url);




















// $mac=$_SESSION["id"];
// $ap=$_SESSION["ap"];
// $last_updated = date("Y-m-d H:i:s");

/*
Collecting the data entered by users of type "new" or "repeat_old" in form. It will be posted to the DB.
For "repeat_recent" type users no change will be made in the DB, they'll be authorized directly
*/

// if($_SESSION["user_type"]=="new" || $_SESSION["user_type"]=="repeat_old"){
//   $phone=$_SESSION["phone"];
//   $fname = $_POST['fname'];
//   $lname = $_POST['lname'];
//   $aptunit = $_POST['aptunit'];
//   $offers = $_POST['c2'];  
  
//   if ($offers != "Y") {
//           $offers = "N";
//   }
// }

// require __DIR__ . '/vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
// $dotenv->load();

// $controlleruser = $_SERVER['CONTROLLER_USER'];
// $controllerpassword = $_SERVER['CONTROLLER_PASSWORD'];
// $controllerurl = $_SERVER['CONTROLLER_URL'];
// $controllerversion = $_SERVER['CONTROLLER_VERSION'];
// $duration = $_SERVER['DURATION'];

// $host_ip = $_SERVER['HOST_IP'];
// $db_user = $_SERVER['DB_USER'];
// $db_pass = $_SERVER['DB_PASS'];
// $db_name = $_SERVER['DB_NAME'];

// if($_SESSION["user_type"]!="repeat_recent"){

//   $con=mysqli_connect($host_ip,$db_user,$db_pass,$db_name);

//   if (mysqli_connect_errno()) {
//           echo "Failed to connect to SQL: " . mysqli_connect_error();
//   }

//   if($_SESSION["user_type"]=="new"){

//     mysqli_query($con, "
//     CREATE TABLE IF NOT EXISTS `$table_name` (
//       `id` int(11) NOT NULL AUTO_INCREMENT,
//       `phone` varchar(45) NOT NULL,
//       `firstname` varchar(45) NOT NULL,
//       `lastname` varchar(45) NOT NULL,
//       `apartment` varchar(45) NOT NULL,
//       `offers` varchar(45) NOT NULL,
//       `mac` varchar(45) NOT NULL,
//       `ap` varchar(45) NOT NULL,
//       `last_updated` varchar(45) NOT NULL,
//       PRIMARY KEY (`id`),
//       UNIQUE KEY `id_UNIQUE` (`id`)
//     )");

//     mysqli_query($con,"INSERT INTO `$table_name` (phone, firstname, lastname, apartment, offers, mac, ap, last_updated) VALUES ('$phone', '$fname', '$lname', '$aptunit', '$offers', '$mac', '$ap', '$last_updated')");

//   }
//   else {
//     $db_id = $_SESSION["db_id"];
//     mysqli_query($con,"UPDATE `$table_name` SET phone='$phone', firstname='$fname', lastname='$lname', apartment='$aptunit', offers='$offers', ap='$ap', last_updated='$last_updated' WHERE id='$db_id'");
//   }

//   mysqli_close($con);
// }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>ZigsaWiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="refresh" content="5;url=thankyou.htm" />
  <link rel="stylesheet" href="bulma.min.css" />
  <script defer src="fontawesome-free-5.3.1-web\js\all.js"></script>
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css">  
</head>
<body>
	<div class="bg">

		<div id="alphawifi2" class="content is-size-2">AlphaWifi</div>
		<div id="devices" class="content is-size-6">Please wait, you are being </div>
		<div id="devices" class="content is-size-6">authorized on AlphaWiFi</div>

	</div>
</body>
</html>
