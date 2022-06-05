<div class="left-side-bar">				<!--Aqui se encuentra la barra lateral izquierda-->
		<div class="brand-logo">
			<a href="index">
				<img style="max-width: 20%; " src="vendors/images/logo_veterianria.svg" alt="" class="dark-logo">
				<img style="max-width: 20%;" src="vendors/images/logo_veterinaria_oscuro.png" alt="" class="light-logo">
				<div class="sidebar-principal">
					<div class="sidebar-small-cap" style="left: 1.55vw !important;">Veterinaria</div>
				</div>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul>
					<li>
						<a href="tipo" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-dog"></span><span class="mtext">Tipos de animales</span>
						</a>
					</li>
					<li>
						<a href="pacientes" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-cat"></span><span class="mtext">Pacientes</span>
						</a>
					</li>
					<li>
						<a href="consultas" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-agenda"></span><span class="mtext">Consultas</span>
						</a>
					</li>
					<li>
						<a href="bitacora" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-book"></span><span class="mtext">Bitácora del paciente</span>
						</a>
					</li>
					<li>
						<a href="calculadora" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calculator"></span><span class="mtext">Cálculo de dosis</span>
						</a>
					</li>

					<?php
					if ($_SESSION['VSPINT']['tipo'] == 3) {
						?>
						<li>
							<a href="users" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-user2"></span><span class="mtext">Usuarios</span>
							</a>
						</li>
						<?php
					}
					?>
					

				</ul>
			</div>
		</div>
	</div>
