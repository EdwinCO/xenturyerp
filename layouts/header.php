<?php $user=current_user(); 
      //header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
	<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php if(!empty($page_title))
			echo remove_junk($page_title);
            elseif(!empty($user))
			echo ucfirst($user['name']);
            else echo "Sistema simple de inventario"; ?>
		</title>
		
		<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
		
		<link rel="icon" href="favicon.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
		<link rel="stylesheet" href="libs/css/main.css"/>
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		
		
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="libs/js/functions.js"></script>
	</head>
	<body>
		<?php if($session->isUserLoggedIn(true)): ?>
		<header id="header">
			<div class="logo pull-left" style="text-decoration:none;color:black;background-color:white;">
				<a href="http://localhost/sistema/home.php" style="text-decoration:none;color:black;">
					<font size="4">XENTURY SOLUTIONS</font>
				</a>
			</div>
			<div class="header-content">
				<div class="header-date pull-left">
					<strong><?php echo date("d/m/Y g:i a"); ?></strong>
				</div>
				<div class="pull-right clearfix">
					<ul class="info-menu list-inline list-unstyled">
						<li class="profile">
							<a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
								<img src="uploads/users/<?php echo $user['image']; ?>" alt="user-image" class="img-circle img-inline">
								<span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?id=<?php echo (int)$user['id']; ?>">
										<i class="glyphicon glyphicon-user"></i>
										Perfil
									</a>
								</li>
								<li>
									<a href="edit_account.php" title="edit account">
										<i class="glyphicon glyphicon-cog"></i>
										Configuración
									</a>
								</li>
								<li class="last">
									<a href="logout.php">
										<i class="glyphicon glyphicon-off"></i>
										Salir
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</header>
		<div class="sidebar">
			<?php
				if($user['user_level']==='1'):
					include_once('admin_menu.php');
				elseif($user['user_level']==='2'):
					include_once('special_menu.php');
				elseif($user['user_level']==='3'):
					include_once('user_menu.php');
				endif;
			?>
		</div>
		<?php endif; ?>
		<div class="page">
			<div class="container-fluid">