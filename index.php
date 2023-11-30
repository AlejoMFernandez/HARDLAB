<!DOCTYPE html>
<html>
	<head>
		<title>HardLAB</title>
		<link rel="stylesheet" type="text/css" href="css/style2.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<link rel="Website Icon" type="png" href="images/pc.png">
	</head>
	<body>
		<header>
        <div class="part1">
            <a class="logo-text2" href="#"> HARDLAB</a>
        </div>
        <div class="part2">
            <nav class="headeroptions">
                <ul>
                    <li><a class="cdm1" href="#cmd1"><img src="images\labsicon.png" alt=""></a></li>
                </ul>
            </nav>
        </div>
        <div class="part3">
			<a class="login-btn" href="../php/login.php">Acceder <img class="user-img" src="images/user.png" alt=""></a>
        </div>
		</header>
		<main class="allin">
			<section id="imagebackground">
				<div class="imageheader">
					<img src="images\img4.jpeg" alt="" class="backgroundimage">
					<div class="content">
						<h2>HARDLAB</h2>
						<h2>HARDLAB</h2>
					</div>
				</div>
			</section>
			<section id="cmd1">
				<div class="cmdcontainer">
					<div class="cmdtop">
						<div class="cmdoption">
							<div class="cmdtitle"><img class="cmdicon" src="images\cmdicon2.png" alt="">LABORATORIOS</div>
							<div class="cmd-minimize"></div>
							<div class="cmd-expand"></div>
							<div class="cmd-close"></div>
						</div>
					</div>
					<div class="cmdmain">
						<div class="cmdtext">Murialdo:\LABORATORIOS\Técnica></div>
						<section id="laboratorios">
							<div id="laboratoriosprimaria">
								<?php include("php/laboratorios.php") ?>
							</div>
						</section>	
					</div>
				</div>
			</section>
		</main>
		<footer>
			<div class="footer-container">
				<div class="footer-content">
					<div class="footer-title">
						Proyecto<div class="footer-hardlab">HARDLAB</div>
					</div>
					<div class="footer-info">
						Fernandez Alejo - Di Nicola Briana - Montarzino Giulianna - Paone Nicolas - Pittis Valentino
					</div>
				</div>
			</div>
		</footer>
	</body>
	<script src="btnacceder.js"></script>
</html>
