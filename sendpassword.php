<?php
$email=$_GET["email"];
$conn=new mysqli("localhost:3306", "root", "1234", "chanakya");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$s="select * from accounts where email='$email';";
$r=$conn->query($s);
if($r->num_rows)
{
    require'PHPMailer-5.2.25/PHPMailerAutoload.php'; 
$x=rand(100000,500000);
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
	$mail->Subject = 'REQUEST FOR NEW PASSWORD';
	$mail->Body = "your new password is TNPC-'$x'";
        $mail->AddAddress($_GET["email"]);
 	if(!$mail->Send()) {
   	 echo "Mailer Error: " . $mail->ErrorInfo;
	}
	$row=$r->fetch_assoc();
        $sql="update accounts set password='$x' where email='$email'";
        $r1=$conn->query($sql);
        if(!$r1)
            echo $conn->error;
        else {
            echo "<html><script>alert('Password Changed kindly check your mail')</script></html>";
            include "login.html";
        }
}
else 
{
    echo "<html><script>alert('Not registered with this mail,kindly register ')</script></html>";
    include "forgotpassword.php";
}
    $conn->close();


?>