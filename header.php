<head>	<title>KMK ITB Choir site</title>	<link rel="icon" type="image/ico" href="img/favicon.ico"> 	<link rel="stylesheet" media="screen" href="css/gumby.css" />	<link rel="stylesheet" media="screen" href="css/header.css"/></head><header>	<div class="row" id="logo">		<div class="one columns image">			<a href="index.php"><img src="img/logo_kmk.jpg" /></a>		</div>		<div class="eleven columns" id="site_title">			<h3><strong>KMK ITB Choir Site</strong></h3>		</div>	</div>	<div class="row navbar" id="nav_bar">		<a class="toggle" gumby-trigger="#nav_bar > .row > ul" href="#"><i class="icon-menu"></i></a>		<ul class="fourteen columns"><?php	session_start();	include_once("config.php");	include_once("functions.php");	$menu = array();	$icon = array();	$target = array();	$role = 4;	if(isset($_SESSION["username"])){		$role = $_SESSION["role"];	}			$sq1 = $op->prepare("		SELECT m.name, m.icon, m.target FROM menu AS m		JOIN role_menu AS r 		ON r.menuID = m.id		WHERE r.roleID = ?		ORDER BY m.priority 	");	$sq1->bind_param('i',$role);	$sq1->execute();	echo $sq1->error;	$sq1->bind_result($v['name'],$v['icon'],$v['target']);	while($sq1->fetch()){		array_push($menu,$v['name']);		array_push($icon,$v['icon']);		array_push($target,$v['target']);	}		for($i = 0; $i < count($menu); $i++){		echo "			<li>				<a href='$target[$i]'>					<i class='$icon[$i]'></i>					$menu[$i]				</a>			</li>		";	}?>		</ul>	</div></header>