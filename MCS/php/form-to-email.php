<?php

$choices = array("none", "Membership", "Golf", "Wedding/Event", "Pool", "Tennis Membership", "Outing/Tournament");

function IsInjected($str)
{
    $injections = array('(\n+)',
           '(\r+)',
           '(\t+)',
           '(%0A+)',
           '(%0D+)',
           '(%08+)',
           '(%09+)'
           );

    $inject = join('|', $injections);
    $inject = "/$inject/i";

    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}

if(isset($_POST["submit"])){
  $select_key = $_POST["select"];
  $select_val = $choices[$_POST["select"]];
  $name = $_POST["name"];
  $lst_name = $_POST["lname"];
  $email = $_POST["email"];
  $phone_number = $_POST["phonenum"];
  $message = $_POST["message"];

  $email_subject = $select_val;
  $email_body = "You have received a new message from $name.\n". "Their number is $phone_number.\n". "They are interested in $select_val.\n". "Here is their message: \n $message";

  if($select_val == "none" || empty($name) || empty($lst_name) || empty($email)){
    header("location: ../contact.html?error=emptyinput");
    exit();
  }

  if(IsInjected($visitor_email)){
      header("location: ../contact.html?error=bademail");
      exit;
  }

  if($select_val == "Membership" || $select_val == "Pool"){
    $to = "codcastingstudio@gmail.com";
    mail($to, $email_subject, $email_body, $headers);
    header("location: ../contact.html?success");
    exit();
  }else if($select_val == "Golf" || "Outing/Tournaments"){
    $to = "codcastingstudio@gmail.com";
    mail($to, $email_subject, $email_body, $headers);
    header("location: ../contact.html?success");
    exit();
  }else if($select_val == "Wedding/Event" || "Tennis Membership"){
    $to = "trachsjb@gmail.com";
    mail($to, $email_subject, $email_body, $headers);
    header("location: ../contact.html?success");
    exit();
  }

}else{
  header("location: ../contact.html");
  exit();
}
