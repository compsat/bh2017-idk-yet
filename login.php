<?php
include "header.php";

// if POST, authenticate user
if(!empty($_POST))
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		$username = mysqli_escape_string($conn, $_POST['username']);
		$password = mysqli_escape_string($conn, $_POST['password']);

		$query = sprintf("select * from users where name = '%s' and password = '%s'", $username, $password);

		$roles = array('donors', 'teachers', 'principals');
		$role = '';
		foreach($roles as $r)
		{
			$query = sprintf("select * from %s where name='%s' and password='%s'", $r, $username, $password);
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) == 1)
			{
				$data = mysqli_fetch_array($result);
				$_SESSION['username'] = $username;
				$_SESSION['id'] = $data['id'];
				$_SESSION['role'] = $r;
				if(!empty($data['school_id']))
				{
					$_SESSION['school_id'] = $data['school_id'];
				}
				$_SESSION['logged_in'] = 1;
				if(empty($_SESSION['login_redirect']))
				{
					header("Location: dashboard.php");
				}
				else
				{
					header("Location: ".$_SESSION['login_redirect']);
					$_SESSION['login_redirect'] = NULL;
				}
				exit();
			}          
		}

		echo 'wrong username or password!';
	}
	else
	{
		echo 'Empty username or password!';
	}
}
else
{   
	if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'])
	{
		header("Location: index.php");
	}
}
?>

<form action="" method="post">
	<div class="login-register-container">
		<div style="flex:2"></div>
		
		<div class="login-register-shape">
		
			<div>
				<p style="font-size: 300%; margin:20px">Login</p>
			</div>

			<div class="form-container">
				<div>
					<input class="inputthing" name="username" type="text" placeholder="Username" autofocus>
				</div>
				<div>
					<input class="inputthing" name="password" type="password" placeholder="Password">
				</div>
			</div>

			<div style="margin-top:40px; margin-bottom: 40px;">
				<input style="font-size:150%" value="Login" type="submit">
			</div>
		</div>
		
		<div style="flex:2"></div>
		
	</div>
</form>
<?php require('footer.php'); ?>