
<?php
session_start();
$_SESSION["name"]=$_GET["name"];
$_SESSION["pwd"]=$_GET["password"];
$_SESSION["type"]=$_GET["type"];
$_SESSION["department"]=$_GET["department"];
$_SESSION["email"]=$_GET["email"];
$name=$_SESSION["name"];
$pwd=$_SESSION["pwd"];
$type=$_SESSION["type"];
$conn=new mysqli("localhost:3306", "root", "1234", "chanakya");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$s="select * from accounts where username='$name';";
$r=$conn->query($s);
if($r->num_rows || $r1->num_rows)
{
    while($row=$r->fetch_assoc())
    {
        if($row[username]==$name || $row[type]==$type)
        {
            echo "<html><body><center><div style='background:black;font:26px;color:whitesmoke'><hr>THIS USERNAME ALREADY EXISTS TRY ANOTHER NAME<hr></div></center></body></html>";
            include "signup.html";
            exit();
        }
        
    }
}
else 
{
    header("location:otp.php");
}
    $conn->close();
require'PHPMailer-5.2.25/PHPMailerAutoload.php'; 
$x=rand(10000,50000);
$mail=new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
	$mail->Host ='smtp.gmail.com';
	$mail->Port = '587';
	$mail->isHTML(true);
	$mail->Username = 'chanakyagondi@gmail.com';
	$mail->Password = 'chanakya123';
	$mail->SetFrom('chanakyagondi@gmail.com');
	$mail->Subject = 'Hello World';
	$mail->Body = "your otp is TNPC-'$x'";
        $mail->AddAddress($_GET["email"]);
 	if(!$mail->Send()) {
   	 echo "Mailer Error: " . $mail->ErrorInfo;
	}
	
$_SESSION["otp"]=$x;

?> 

