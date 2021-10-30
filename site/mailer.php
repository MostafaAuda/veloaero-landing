<?php
$name = $_POST["name"];
$email = $_POST["email"];
$address = $_POST["address"];
$details = $_POST["details"];
 
$EmailTo = "hossammohsen37@outlook.com";
$Subject = "Message from " . $name;
 echo "hossam";
// prepare email body text
$Body = "Name: ";
$Body .= $name;
$Body .= "\n";
 
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
 
$Body .= "Phone Number: ";
$Body .= $address;
$Body .= "\n";
 
$Body .= "More Details: ";
$Body .= $details;
$Body .= "\n";

   
// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);
 
// redirect to success page
if ($success){
    setcookie('success','true');
}else{
    setcookie('success','false');
}
header("Location: /");

exit();
?>