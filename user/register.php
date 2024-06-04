<?php
	function iPass($str){
		$c=0;

		if(preg_match('/[_|\-|+|\|=|*|!|@|#|$|%|^|~|&|(|)]+/',$str)) $c++;

		if(preg_match('/\d/',$str)) $c++;

		if(preg_match('/[A-Z]/',$str)) $c++;

		if(preg_match('/[a-z]/',$str)) $c++;

		$x=strlen($str);

		if($x>=8 && $c==4){
			return true;
		}else return false;
	}

	if(isset($_POST['register'])){
		//recaptcha
		$secret="6LfZShkcAAAAAJ420tI4s4rLMwwlxk7PFo4_rUnW";
		$response=$_POST['g-recaptcha-response'];
		$remoteip = $_SERVER['REMOTE_ADDR'];
		$url ="https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
		$data = file_get_contents($url);
		$row=json_decode($data,true);

		//if human verification is success
		if($row["success"]==false){
			$human_error=" This is Needed!";
		}
		
		//get data from register form	
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$cpass=$_POST['cpass'];

		//checkv variable from user input
		if(empty(trim($fname))){
			$fname_error=" Your First Name cannot be empty~";
		}
		if(empty(trim($lname))){
			$lname_error=" Your Last Name cannot be empty~";
		}
		
		//passing password to check the strength
		$value=iPass($pass);
		if($value==false) {
			$pas_error=" Your password should contain at least 8 character [Special Character, Number, Capital and Small Letter]";
		}
		if(!($pass==$cpass)){
			$pas_error1=" Password and Confirm Password Must be the Same!";
		}

		include('login-register.php');
		$sql="SELECT * FROM customer WHERE cusEmail='$email' LIMIT 1";
		$res=mysqli_query($conn,$sql);

		if(mysqli_num_rows($res)==1){
			$_SESSION['exist']="Your account exist. Please Login.";
			$email_error="error";
			header("location:".SITEURL."user/login-register.php");
		}
		

		//if all pass
		if(empty($fname_error) && empty($email_error) && empty($lname_error) && empty($pas_error) && empty($human_error) && empty($pas_error1) && empty($error)){
			$pass=password_hash($pass,PASSWORD_DEFAULT,['cost' => 15]);
			$fname=mysqli_real_escape_string($conn,$_POST['fname']);
			$lname=mysqli_real_escape_string($conn,$_POST['lname']);
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$pass=mysqli_real_escape_string($conn,$pass);

			//generate verification key by time
			$vkey=md5($fname.$email.time());
			$current=date('Y-m-d H:i');
			$expire_date = date('Y-m-d H:i',strtotime('+10 minutes',strtotime($current)));
	
			$sql1="INSERT INTO CUSTOMER SET
				cusFName='$fname',
				cusLName='$lname',
				cusEmail='$email',
				passw='$pass',
				vkey='$vkey',
				vkeyexpired='$expire_date'
			";

			$res1=mysqli_query($conn,$sql1);

			if($res1){
				$to=$email;
				$subject="Email Verification";
				$message="
					Hi $fname,<br>

					We just need to verify your email address before you can access to FreshGrocers.<br>
			
					Verify your email address by <a href='http://localhost/onlinegrocery/user/reg_verify.php?vkey=$vkey'>Click Me</a><br>
					Verification Link will be vaild for 10 minutes.<br>
			
					Thanks! &#8211; FreshGrocers<br>
				";
				$headers ="From: ffreshgrocers@gmail.com \r\n";
				$headers = "MIME-Version: 1.0" . "\r\n"; //set content type when sending html email
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				mail($to,$subject,$message,$headers);

				$_SESSION['signup']="Success";
				header("location:".SITEURL."user/login-register.php");
			}else{

			}
		}
	}
?>