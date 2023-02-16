<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

	<!-- Sidebar -->
	<div class="sidebar">


		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
															with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="{{ route('dashboard_ticket') }}" class="nav-link {{ areActiveRoutes(['dashboard_ticket']) }}">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('checkin') }}" class="nav-link {{ areActiveRoutes(['checkin']) }}">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Checkin
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('checkout') }}" class="nav-link {{ areActiveRoutes(['checkout']) }}">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Checkout
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('user.logout') }}" class="nav-link {{ areActiveRoutes(['user.logout']) }}">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
