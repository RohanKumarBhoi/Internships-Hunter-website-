<?php
session_start();
$con=mysql_connect("sql202.byethost12.com","b12_16055662","qwerty");
mysql_select_db("b12_16055662_InternshipHunters");
if($_SESSION['fname']==null ||$_SESSION['lname']==null||$_SESSION['email']==null)
{
	header('location:index.php');
}
if(isset($_POST['signout']))
{
	$_SESSION['fname']=null;
	$_SESSION['lname']=null;
	$_SESSION['email']=null;
	//$_SESSION['psswrd']=null;
	//$_SESSION['mob']=null;
	//$_SESSION['address']=null;
	//$_SESSION['age']=null;
	//$_SESSION['sex']=null;
	//$_SESSION['bday']=null;
	//$_SESSION['lang']=null;
	//$_SESSION['soft']=null;
	header('location:index.php');
}
if(isset($_POST['postint']))
{
	header('location:postint.php');
}
if(isset($_POST['settings']))
{
	header('location:settings.php');
}
if(isset($_POST['login']))
{
if(isset($_POST['email']) && isset($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['pass']))
{
	$email=$_POST['email'];
	$psswrd=$_POST['pass'];
	$sql="select email from users where email='$email'";
	if(mysql_num_rows(mysql_query($sql,$con))!=0)
	{
		$sql="select email,psswrd from users where email='$email' and psswrd='$psswrd'";
		if(mysql_num_rows(mysql_query($sql,$con))!=0)
		{
			$sql="select fname from users where email='$email' && psswrd='$psswrd'"; 
			$_SESSION['fname']=mysql_result(mysql_query($sql,$con),0);
			$sql="select lname from users where email='$email' && psswrd='$psswrd'"; 
			$_SESSION['lname']=mysql_result(mysql_query($sql,$con),0);
			$sql="select email from users where email='$email' && psswrd='$psswrd'";
			$_SESSION['email']=mysql_result(mysql_query($sql,$con),0);
			header('location: loggedin.php');
		}
		else
		{
			/*echo "<script type='text/javascript'>\n";
			echo "alert('wrong password');\n";
			echo "</script>";*/
		}
	}
	else
	{
		/*echo "<script type='text/javascript'>\n";
		echo "alert('account not found');\n";
		echo "</script>";*/
		 
	}
}
}
if(!isset($_SESSION['query']))
	$_SESSION['query']="SELECT company,description from intern where 1 order by edate desc";
else if(isset($_POST['find']) && !empty($_POST['find']))
{
	$find=$_POST['find'];
	$_SESSION['query']="select company,description from intern where lower(description) like lower('%$find%') or lower(company) like lower('%$find%') or lower(location) like lower('%$find%') or lower(edate) like lower('%$find%') or lower(duration) like lower('%$find%') or lower(areas) like lower('%$find%') or lower(eligibility) like lower('%$find%') or lower(stipend) like lower('%$find%') order by edate desc";
	$_SESSION['i']=0;
}
else if(!isset($_POST['next']))
	$_SESSION['query']="SELECT company,description from intern where 1 order by edate desc";
$intsp0=null;
$intsp1=null;
$intsp2=null;
$intsp3=null;
$intsp4=null;
$intspc0=null;
$intspc1=null;
$intspc2=null;
$intspc3=null;
$intspc4=null;
if(!isset($_SESSION['t']))
	$_SESSION['t']=0;
if(!isset($_SESSION['i']))
	$_SESSION['i']=0;
else if(!isset($_POST['next']))
	$_SESSION['i']=$_SESSION['t'];
$res=mysql_query($_SESSION['query'],$con);
$row=mysql_num_rows($res);
//$col=mysql_num_fields($res);
if($_SESSION['i']>=$row)
	$_SESSION['i']=0;
if(($_SESSION['i']-$row)<-5)
{
	$intsp0=mysql_result($res,$_SESSION['i']+0,1);
	$intsp1=mysql_result($res,$_SESSION['i']+1,1);
	$intsp2=mysql_result($res,$_SESSION['i']+2,1);
	$intsp3=mysql_result($res,$_SESSION['i']+3,1);
	$intsp4=mysql_result($res,$_SESSION['i']+4,1);
	$intspc0=mysql_result($res,$_SESSION['i']+0,0);
	$intspc1=mysql_result($res,$_SESSION['i']+1,0);
	$intspc2=mysql_result($res,$_SESSION['i']+2,0);
	$intspc3=mysql_result($res,$_SESSION['i']+3,0);
	$intspc4=mysql_result($res,$_SESSION['i']+4,0);
	$_SESSION['t']=$_SESSION['i'];
	$_SESSION['i']=$_SESSION['i']+5;
}
else
{
	$i=$row-$_SESSION['i'];
	if($i==1)
	{
		$intsp0=mysql_result($res,($_SESSION['i']+0),1);
		$intsp1=null;
		$intsp2=null;
		$intsp3=null;
		$intsp4=null;
		$intspc0=mysql_result($res,$_SESSION['i']+0,0);
		$intspc1=null;
		$intspc2=null;
		$intspc3=null;
		$intspc4=null;
		$_SESSION['t']=$_SESSION['i'];
		$_SESSION['i']=$_SESSION['i']+1;
	}
	else if($i==2)
	{
		$intsp0=mysql_result($res,$_SESSION['i']+0,1);
		$intsp1=mysql_result($res,$_SESSION['i']+1,1);
		$intsp2=null;
		$intsp3=null;
		$intsp4=null;
		$intspc0=mysql_result($res,$_SESSION['i']+0,0);
		$intspc1=mysql_result($res,$_SESSION['i']+1,0);
		$intspc2=null;
		$intspc3=null;
		$intspc4=null;
		$_SESSION['t']=$_SESSION['i'];
		$_SESSION['i']=$_SESSION['i']+2;
	}
	else if($i==3)
	{
		$intsp0=mysql_result($res,$_SESSION['i']+0,1);
		$intsp1=mysql_result($res,$_SESSION['i']+1,1);
		$intsp2=mysql_result($res,$_SESSION['i']+2,1);
		$intsp3=null;
		$intsp4=null;
		$intspc0=mysql_result($res,$_SESSION['i']+0,0);
		$intspc1=mysql_result($res,$_SESSION['i']+1,0);
		$intspc2=mysql_result($res,$_SESSION['i']+2,0);
		$intspc3=null;
		$intspc4=null;
		$_SESSION['t']=$_SESSION['i'];
		$_SESSION['i']=$_SESSION['i']+3;
	}
	else if($i==4)
	{
		$intsp0=mysql_result($res,$_SESSION['i']+0,1);
		$intsp1=mysql_result($res,$_SESSION['i']+1,1);
		$intsp2=mysql_result($res,$_SESSION['i']+2,1);
		$intsp3=mysql_result($res,$_SESSION['i']+3,1);
		$intsp4=null;
		$intspc0=mysql_result($res,$_SESSION['i']+0,0);
		$intspc1=mysql_result($res,$_SESSION['i']+1,0);
		$intspc2=mysql_result($res,$_SESSION['i']+2,0);
		$intspc3=mysql_result($res,$_SESSION['i']+3,0);
		$intspc4=null;
		$_SESSION['t']=$_SESSION['i'];
		$_SESSION['i']=$_SESSION['i']+4;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>Internships Hunter</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="" />
    <link href="style.css<?php print('?'.filemtime('stil.css'));?>" rel="stylesheet" type="text/css" />
</head>

<body style="background-image:url(images/back.png);background-attachment:fixed">
    <div id="page">
        <div id="header">
            <h1><a href="#">Internships Hunter</a></h1>
            <p id="subtitle">...for those who look ahead</p>
        </div>
        <div id="menu0">
        	<div id="search" style="min-width:1px">
                <form action="loggedin.php" method="POST">
				<input type="text" name="find">
				<input type="submit" name="search" id="submit" class="submit" value="Search"/>
                </form>
            </div>
        </div>
        <div id="menu">
            <ul>
                <li><a href="loggedin.php">Home</a></li>
                <li><a href="about2.php">About</a></li>
                <li><a href="faq2.php">FAQs</a></li>
                <li><a href="contact2.php">Contact</a></li>
                <li><a href="privacy2.php">Privacy</a></li>
                <li><a href="terms2.php">Terms</a></li>
            </ul>
        </div>
        <div id="main">	
            <div id="sidebar">
                <div id="login">
                    <h2>Welcome <?php echo $_SESSION['fname']?> </h2>
                    <div class="box2">
                        <form method="post" action="loggedin.php">
                        	<input type="submit" name="postint" id="submit" class="submit" value="POST" /><br />
                            <input type="submit" value="SETTINGS" class="submit" name="settings"><br />
							<input type="submit" value="LOG OUT" class="submit" name="signout"><br />
                        </form>
                    </div>
                </div><!-- login -->
                <div class="box">
                    <h2>Similar sites</h2>
                    <div class="box2">
                        <ul>
                            <li><a href="http://www.letmeknow.in">letmeknow.in</a></li>
                            <li><a href="http://www.internships.com">internships.com</a></li>
                            <li><a href="http://www.internmatch.com">internmatch.com</a></li>
                            <li><a href="http://www.letsintern.com">letsintern.com</a></li>
                            <li><a href="http://www.experience.com">experience.com</a></li>
                            <li><a href="http://www.twenty19.com">twenty19.com</a></li>
                            <li><a href="http://www.internweb.com">internweb.com</a></li>
                        </ul>
                    </div>
                </div><!-- box -->					
            </div><!-- sidebar -->    	              
            <div id="content">
                <div id="contheader">
                    <h2>Welcome to <strong>INTERNSHIPS HUNTER</strong>!</h2>
                </div>		
                <div>	
                    <div class="post">
                        <h2>Latest internship posts</h2><br>
                        <?php if($intspc0==null && $intsp0==null && $intspc1==null && $intsp1==null && $intspc2==null && $intsp2==null && $intspc3==null && $intsp3==null && $intspc4==null && $intsp4==null){?>
                        <div id="content3">
								 <span style="letter-spacing:1px;text-align:center;color:#F00"><strong>*No matches found.</strong></span>
                        </div>
                        <?php }?>
                        <?php if($intspc0!=null && $intsp0!=null){?>
                        <div id="content3">
                        
                            <div><strong>
								<?php
									global $intspc0;
									echo $intspc0;
								?>
                            </strong>
                                <br>
                                <br>
								<?php
									global $intsp0;
									echo $intsp0;
								?>
                                <br>
                                <div id="next">
   								 <form action="apply.php" method="POST">
   								 <input type="hidden" name="description0" value="<?php echo $intsp0?>">
   								 <input type="submit" name="apply0" class="submit" value="more info">
                                 </form>
                                 </div>
                        </div></div>
                        <?php }?>
                        <br>
                        <?php if($intspc1!=null && $intsp1!=null){?>
                        <div id="content3">
                        
                           	<div><strong> 
								<?php
									global $intspc1;
									echo $intspc1;
								?>
                           	</strong>
                                <br>
                                <br>
                                <?php
									global $intsp1;
									echo $intsp1;
								?>
                                <div id="next">
   								 <form action="apply.php" method="POST">
   								 <input type="hidden" name="description1" value="<?php echo $intsp1?>">
   								 <input type="submit" name="apply1" class="submit" value="more info">
                                 </form>
                                 </div>
                        </div></div>
                        <?php }?>
                        <br>
                        <?php if($intspc2!=null && $intsp2!=null){?>
                        <div id="content3">
                        
                           	<div><strong> 
								<?php
									global $intspc2;
									echo $intspc2;
								?>
                            </strong>
                                <br>
                                <br>
                                <?php
									global $intsp2;
									echo $intsp2;
								?> 
                                <div id="next">
   								 <form action="apply.php" method="POST">
   								 <input type="hidden" name="description2" value="<?php echo $intsp2?>">
   								 <input type="submit" name="apply2" class="submit" value="more info">
                                 </form>
                                 </div>
                        </div></div>
                        <?php }?>
                        <br>
                        <?php if($intspc3!=null && $intsp3!=null){?>
                        <div id="content3">
                        
                            <div><strong>
								<?php
									global $intspc3;
									echo $intspc3;
								?>
                            </strong>
                                <br>
                                <br>
                                <?php
									global $intsp3;
									echo $intsp3;
								?> 
                                <div id="next">
   								 <form action="apply.php" method="POST">
   								 <input type="hidden" name="description3" value="<?php echo $intsp3?>">
   								 <input type="submit" name="apply3" class="submit" value="more info">
                                 </form>
                                 </div>
                        </div></div>
                        <?php }?>
                        <br>
                        <?php if($intspc4!=null && $intsp4!=null){?>
                        <div id="content3">
                        
                            <div>
                            <div><strong>
								<?php
									global $intspc4;
									echo $intspc4;
								?>
                            </strong>
                                <br>
                                <br>
                                <?php
									global $intsp4;
									echo $intsp4;
								?></div>  
                                <div id="next" style="">
   								 <form action="apply.php" method="POST">
   								 <input type="hidden" name="description4" value="<?php echo $intsp4?>">
   								 <input type="submit" name="apply4" class="submit" value="more info">
                                 </form>
                                 </div>
                        </div></div>
                        <?php }?>
                        <?php if($intspc0==null && $intsp0==null && $intspc1==null && $intsp1==null && $intspc2==null && $intsp2==null && $intspc3==null && $intsp3==null && $intspc4==null && $intsp4==null){?>
                        <?php }else{?>
                        <div id="next">
                			<form action="loggedin.php" method="POST">
                            <input type="hidden">
							<input type="submit" name="next" id="submit" class="submit" value="next page" />
                			</form>
                		</div>
                        <?php }?>
                    </div><!-- post -->			
                </div><!-- content2 -->								              
            </div><!-- content -->                    
            <div class="clearing">&nbsp;</div> 
            <div id="footer">
                <p>Copyright &copy; 2011 Bhubanananda Chhatriya and Rohan Kumar Bhoi,All rights reserved.</p>
            </div>
        </div><!-- main -->
    </div><!-- page -->
</body>
</html>