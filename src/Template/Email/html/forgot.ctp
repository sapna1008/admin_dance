<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dance App</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet"> 
</head>

<style>
	.reset{
		background:#cb202d;
		padding:15px 20px;
		text-transform:uppercase;
		display:inline-block;
		color:#fff;
		border-radius: 4px;
		text-decoration:none;
		font-weight:500;
		}
		
.defult_btn:hover,.defult_btn:focus {
	background-color: #113f61 !important;
	border-color: #113f61 !important;
	border-radius: 4px;
	color: #fff;
}
</style>
 
<body style="padding:15px 0; background: url() repeat #dddddd;
		margin:0px auto;
		font-family: 'Roboto', sans-serif;
		font-weight:400;
		background-size: 160px;">
<table width="600" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#fffefb; text-align:center;">
  <tr style="background:#fff;">
    <td style="text-align:center; padding-top:20px; padding-bottom:20px; border-bottom:2px solid #ce0038;">
		Dance App
    </td>
  </tr>  
  <tr>
<td>
<h2 style="font-weight:500;
                margin-bottom:1px;">Hi <?php if(isset($user['fname'])){ echo $user['fname']; } ?>,</h2>
<h2 style="margin-top:0; font-weight:500;
		margin-bottom:1px;">Reset your password </h2>



<p style="color:#666;
		font-size:14px;">Did you just make a request to reset your password? <br />
Yes, Go right ahead.</p>

<p>Your OTP is : <?php echo $otp; ?></p>

<p style="color:#666;
		font-size:14px;text-align: center;"> Issued on behalf of <br/> Dance App </p>


    </td>  
  </tr>    
</table>
</body>
</html>