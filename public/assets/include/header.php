
<div class="header">
	<div class="header-left">
		<div class="menu-icon dw dw-menu"></div>
	</div>
	<div class="header-right">
		<div class="dashboard-setting user-notification">
			<div class="dropdown">
				<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
					<i class="dw dw-settings2"></i>
				</a>
			</div>
		</div>
		<div style="margin-top: auto; margin-bottom: auto;" class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-name"><?=$_SESSION['VSPINT']['nombre']?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="controller/logout"><i class="dw dw-logout"></i> Cerrar Sesión</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="right-sidebar">
	<div class="sidebar-title">
		<h3 class="weight-600 font-16 text-blue">
			Configuraciones de Interfaz
			<span class="btn-block font-weight-400 font-12">Configuraciones de la interfaz de usuario</span>
		</h3>
		<div class="close-sidebar" data-toggle="right-sidebar-close">
			<i class="icon-copy ion-close-round"></i>
		</div>
	</div>
	<div class="right-sidebar-body customscroll">
		<div class="right-sidebar-body-content">
			<h4 class="weight-600 font-18 pb-10">Color del encabezado</h4>
			<div class="sidebar-btn-group pb-30 mb-10">
				<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">Claro</a>
				<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Oscuro</a>
			</div>

			<h4 class="weight-600 font-18 pb-10">Color de la barra lateral</h4>
			<div class="sidebar-btn-group pb-30 mb-10">
				<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">Claro</a>
				<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Oscuro</a>
			</div>


			<div class="reset-options pt-30 text-center">
				<button class="btn btn-danger" id="reset-settings">Restablecer Configuración</button>
			</div>
		</div>
	</div>
</div>
