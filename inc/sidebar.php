<nav class="sidebar sidebar-sticky">
    <div class="sidebar-content  js-simplebar">
        <a class="sidebar-brand" href="index.php">
            <i class="align-middle" data-feather="layers"></i>
            <span class="align-middle">SISPRO</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Principal
            </li>
            <li class="sidebar-item active">
                <a href="#dashboards" data-toggle="collapse" class="font-weight-bold sidebar-link">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Escritorio</span>
                    <!-- <span class="sidebar-badge badge badge-primary">14</span> -->
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show">
                    <li class="sidebar-item active"><a class="sidebar-link" href="index.php">Default</a></li>
                </ul>
            </li>
			<li class="sidebar-header">
				RR:HH
			</li>
            <?php
				if ($_SESSION['USU_tipo'] == 1) {
					echo '
						<li class="sidebar-item">
							<a href="#users" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
								<i class="align-middle" data-feather="users"></i> <span class="align-middle">Usuarios</span>
							</a>
							<ul id="users" class="sidebar-dropdown list-unstyled collapse">
								<li class="sidebar-item"><a class="sidebar-link" href="add-user.php">Añadir</a></li>
								<li class="sidebar-item"><a class="sidebar-link" href="all-users.php">Ver Todo</a></li>
							</ul>
						</li>
						';
            	}
            ?>
						<li class="sidebar-item">
							<a href="#clients" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
								<i class="align-middle" data-feather="users"></i> <span class="align-middle">Clientes</span>
							</a>
							<ul id="clients" class="sidebar-dropdown list-unstyled collapse">
								<li class="sidebar-item"><a class="sidebar-link" href="add-client.php">Añadir</a></li>
								<li class="sidebar-item"><a class="sidebar-link" href="all-clients.php">Ver Todo</a></li>
							</ul>
						</li>
			<?php
				if ($_SESSION['USU_tipo'] == 1) {
					echo '
						<li class="sidebar-item">
							<a href="#empleados" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
								<i class="align-middle" data-feather="users"></i> <span class="align-middle">Empleados</span>
							</a>
							<ul id="empleados" class="sidebar-dropdown list-unstyled collapse">
								<li class="sidebar-item"><a class="sidebar-link" href="add-employee.php">Añadir</a></li>
								<li class="sidebar-item"><a class="sidebar-link" href="all-employee.php">Ver Todo</a></li>
							</ul>
						</li>
					';
            	}
            ?>
            <li class="sidebar-header">
                Inventario
            </li>
            <li class="sidebar-item">
                <a href="#categoria" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                    <i class="align-middle" data-feather="box"></i> <span class="align-middle">Categoría</span>
                </a>
                <ul id="categoria" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="add-category.php">Añadir Categoría</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="all-categories.php">Ver Categorías</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#productos" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Productos</span>
                </a>
                <ul id="productos" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="add-product.php">Añadir Productos</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="all-products.php">Ver Productos</a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                Producción
            </li>
            <li class="sidebar-item">
                <a href="#produccion" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Órdenes</span>
                </a>
                <ul id="produccion" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="add-order.php">Añadir</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="all-orders.php">Ver Todo</a></li>
                </ul>
            </li>
            <!-- <li class="sidebar-item">
                <a href="#procesos" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Procesos</span>
                </a>
				<ul id="procesos" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="add-process.php">Añadir</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="all-process.php">Ver Todo</a></li>
                </ul>
            </li> -->
			<?php
				if ($_SESSION['USU_tipo'] == 1) {
					echo '
						<li class="sidebar-header">
							Reportes
						</li>
						<li class="sidebar-item">
							<a href="#ordenes" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
								<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Órdenes</span>
							</a>
							<ul id="ordenes" class="sidebar-dropdown list-unstyled collapse">
								<li class="sidebar-item"><a class="sidebar-link" href="reporte-ordenes.php">Ver Reportes</a></li>
							</ul>
						</li>
						<li class="sidebar-item">
							<a href="#pagos" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
								<i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Pagos</span>
							</a>
							<ul id="pagos" class="sidebar-dropdown list-unstyled collapse">
								<li class="sidebar-item"><a class="sidebar-link" href="all-payments.php">Ver Todo</a></li>
							</ul>
						</li>
				';
            	}
            ?>

            <!-- <li class="sidebar-item">
						<a href="#layouts" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="sidebar"></i> <span class="align-middle">Layouts</span>
            </a>
						<ul id="layouts" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="layouts-sidebar-static.html">Static Sidebar</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="layouts-sidebar-collapsed.html">Collapsed Sidebar</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="layouts-boxed.html">Boxed Layout</a></li>
						</ul>
					</li>
					<li class="sidebar-header">
						Components
					</li>
					<li class="sidebar-item">
						<a href="#ui" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">User Interface</span>
            </a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Alerts</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-buttons.html">Buttons</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-cards.html">Cards</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-general.html">General</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-grid.html">Grid</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-modals.html">Modals</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-notifications.html">Notifications</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-tabs.html">Tabs</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="ui-typography.html">Typography</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a href="#charts" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
              <span class="sidebar-badge badge badge-warning">New</span>
            </a>
						<ul id="charts" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="charts-chartjs.html">Chart.js</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="charts-apexcharts.html">ApexCharts <span class="sidebar-badge badge badge-primary">New</span></a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a href="#forms" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
            </a>
						<ul id="forms" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="forms-layouts.html">Layouts</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="forms-basic-elements.html">Basic Elements</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="forms-advanced-elements.html">Advanced Elements</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="forms-input-groups.html">Input Groups</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="forms-editors.html">Editors</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="forms-validation.html">Validation</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="forms-wizard.html">Wizard</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a href="#tables" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Tables</span>
            </a>
						<ul id="tables" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="tables-bootstrap.html">Bootstrap</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="tables-datatables.html">DataTables</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a href="#icons" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
              <span class="sidebar-badge badge badge-primary">450</span>
            </a>
						<ul id="icons" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="icons-feather.html">Feather</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="icons-font-awesome.html">Font Awesome</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a href="#maps" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
            </a>
						<ul id="maps" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="maps-google.html">Google Maps</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="maps-vector.html">Vector Maps</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a href="#pages" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
              <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Pages</span>
            </a>
						<ul id="pages" class="sidebar-dropdown list-unstyled collapse ">
							<li class="sidebar-item"><a class="sidebar-link" href="pages-invoice.html">Invoice</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Pricing</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="pages-kanban.html">Kanban Board <span class="sidebar-badge badge badge-primary">New</span></a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="pages-404.html">404 Page</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="pages-500.html">500 Page</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="pages-blank.html">Blank Page</a></li>
						</ul>
					</li> -->
        </ul>

        <!-- <div class="sidebar-cta">
					<button type="button" class="close sidebar-cta-close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-1">Upgrade to pro</strong>
						<div class="mb-2">
							Showcase your work with our interactive portfolio on your custom domain
						</div>
						<a href="#" class="btn btn-outline-primary">Upgrade</a>
					</div>
				</div> -->
    </div>
</nav>