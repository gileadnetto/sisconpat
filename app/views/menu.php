<!-- Main Navbar-->
<header class="header">
	<nav class="navbar">
		<div class="container-fluid">
			<div class="navbar-holder d-flex align-items-center justify-content-between">
				<!-- Navbar Header-->
				<div class="navbar-header">
				<!-- Navbar Brand --><a href="index.html" class="navbar-brand d-none d-sm-inline-block">
					<div class="brand-text d-none d-lg-inline-block"><span>Sis </span><strong>conpat</strong></div>
					<div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>SCPT</strong></div>
				</a>
				<!-- Toggle Button-->
				<a id="toggle-btn" href="#"
					class="menu-btn active"><span></span><span></span><span></span></a>
				</div>
				<!-- Navbar Menu -->
				<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
				<!-- Logout    -->
					<li class="nav-item">
						<a href="login.html" class="nav-link logout">
							<span class="d-none d-sm-inline">Sair</span>
							<i class="fa fa-sign-out"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<div class="page-content d-flex align-items-stretch">
	<!-- Side Navbar -->
	<nav class="side-navbar">
		<!-- Sidebar Header-->
		<div class="sidebar-header d-flex align-items-center">
			<!-- <div class="avatar">
				<img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle">
			</div> -->
			<div class="title">
				<?php 		
					echo '<h1 class="h4">'.$_SESSION['usuario'].'</h1>';
					echo '<p>'.$_SESSION['email'].'</p>';
				?>
			</div>
		</div>
		<!-- Sidebar Navidation Menus-->
		<!-- <span class="heading">Main</span> -->
		<ul class="list-unstyled">
			<li class="active"><a href="home"> <i class="icon-home"></i>Inicio </a></li>
			<li><a href="transferencia"> <i class="icon-grid"></i>Transferencias </a></li>
			<li><a href="localidade"> <i class="fa fa-bar-chart"></i>Locais </a></li>
			<li><a href="patrimonio"> <i class="icon-padnote"></i>Produtos </a></li>
			<li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
				class="icon-interface-windows"></i>Transferencias </a>
				<ul id="exampledropdownDropdown" class="collapse list-unstyled ">
					<li><a href="#">Transferencias</a></li>
					<li><a href="#">Minhas Transferencia</a></li>
					<li><a href="#">Transferir</a></li>
				</ul>
			</li>
			<li><a href="login.html"> <i class="icon-interface-windows"></i>Login page </a></li>
		</ul>
	</nav>
