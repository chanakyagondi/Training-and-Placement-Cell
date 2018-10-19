<?php
session_start();
include 'createcv.php';
$conn=new mysqli("localhost:3306", "root", "1234", "chanakya");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$a=$_SESSION["name"];
$t="select * from student where username='$a';";
$r=$conn->query($t);
        $name=$_GET["name"];
        $address=$_GET["address"];
        $contactno=$_GET["contactnumber"];
        $email=$_GET["email"];
        $dob=$_GET["dob"];
        $gender=$_GET["gender"];
        $schoolname=$_GET["highschoolname"];
        $schoolpercentage=$_GET["highschoolpercentage"];
        $secondaryschoolname=$_GET["secondaryeducationname"];
        $secondaryschoolpercentage=$_GET["secondaryeducationpercentage"];
        $universityname=$_GET["undergraduationname"];
        $universitypercentage=$_GET["undergraduationpercentage"];
        $awards=$_GET["awards"];
        $publications=$_GET["publications"];
        $interests=$_GET["interests"];
if($r->num_rows)
{    
$s="update student 
    set name='$name',
        address='$address',
        contactno='$contactno',
        email='$email',
        dob='$dob',
        gender='$gender',
        schoolname='$schoolname',
        schoolpercentage='$schoolpercentage',
        secondaryschoolname='$secondaryschoolname',
        secondaryschoolpercentage='$secondaryschoolpercentage',
        universityname='$universityname',
        universitypercentage='$universitypercentage',
        awards='$awards',
        publications='$publications',
        interests='$interests'
        where username='$a';";
 if($conn->query($s)==FALSE)
     echo $conn->error;
 echo "upadation succesful";
}
else {
    $s="insert into student(name,address,contactno,email,dob,gender,schoolname,schoolpercentage,secondaryschoolname,
secondaryschoolpercentage,universityname,universitypercentage,awards,publications,interests,username) 
values('$name','$address','$contactno','$email','$dob','$gender','$schoolname','$schoolpercentage','$secondaryschoolname',
    '$secondaryschoolpercentage','$universityname','$universitypercentage','$awards','$publications','$interests','$a');";
  if($conn->query($s)==FALSE)
     echo $conn->error;
  echo "insertion succesful";
}
?>

