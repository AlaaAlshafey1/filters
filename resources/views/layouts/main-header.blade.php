<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
	<div class="container-fluid">

		<div class="main-header-left ">


		</div>

		<div class="main-header-right">

			<div class="nav nav-item  navbar-nav-right ml-auto">


				<div class="nav-item full-screen fullscreen-button">
					<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg"
							class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor"
							stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-maximize">
							<path
								d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
							</path>
						</svg></a>
				</div>
				<div class="dropdown main-profile-menu nav nav-item nav-link">
					<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/logo.jpg')}}"></a>
					<div class="dropdown-menu">
						<div class="main-header-profile bg-primary p-3">
							<div class="d-flex wd-100p">
								<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/logo.jpg')}}"
										class=""></div>
								<div class="mr-3 my-auto">
									<h6>{{ auth()->user()->name }}</h6>
									<span>{{  auth()->user()->getRoleNames()->first() }}</span>
								</div>
							</div>
						</div>
						{{-- <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
						<a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
						<a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
						<a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
						<a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a> --}}
						<a class="dropdown-item" href="#"
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="bx bx-log-out"></i> تسجيل الخروج
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</div>

			</div>

		</div>

	</div>

</div>
<!-- /main-header -->