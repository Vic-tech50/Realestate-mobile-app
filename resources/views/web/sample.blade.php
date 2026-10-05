@extends('web.main')
@section('content')

<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-heade">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="{{ route('admin.home') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Profile
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
							<div class="pd-20 card-box height-100-p">
								<div class="profile-photo">
									
									@if(Auth::user()->passport != null)
									<img
										src="{{ asset('uploads/teachers')}}/{{Auth::user()->passport}}"
										alt=""
										class="avatar-photo"
										style = "height: 150px;"
									/>
									@else
									<img
										src="{{ asset('vendors/images/person.svg') }}"
										alt=""
										class="avatar-photo"
										style = "height: 150px;"
									/>
									@endif

									
								</div>
								<h5 class="text-center h5 mb-0">{{Auth::user()->name}}</h5>
								<p class="text-center text-muted font-14">
									Administrator
								</p>
<div class="profile-info mt-4">
												<h5 class="mb-20 h5" style="color: #093411">Contact Information</h5>
												<ul class="list-unstyled mb-0">
													<li class="d-flex justify-content-between align-items-start py-2 border-bottom">
														<span class="font-weight-bold text-dark">Email Address</span>
														<span class="text-muted text-right ml-4">{{ Auth::user()->email }}</span>
													</li>
													<li class="d-flex justify-content-between align-items-start py-2 border-bottom">
														<span class="font-weight-bold text-dark">Phone Number</span>
														<span class="text-muted text-right ml-4">{{ Auth::user()->phone ?? "Not Provided" }}</span>
													</li>

													<li class="d-flex justify-content-between align-items-start py-2 border-bottom"
														<span class="font-weight-bold text-dark">Gender</span>
														<span class="text-muted text-right ml-4">{{ Auth::user()->gender ?? "Not Provided" }}</span>
													</li>

													<li class="d-flex justify-content-between align-items-start py-2 border-bottom">
														<span class="font-weight-bold text-dark">Date Of Birth</span>
														<span class="text-muted text-right ml-4">{{ Auth::user()->dob ?? "Not Provided" }}</span>
													</li>
													<li class="d-flex justify-content-between align-items-start py-2">
														<span class="font-weight-bold text-dark">Address</span>
														<span class="text-muted text-right ml-4">{{ Auth::user()->address ?? "Not Provided" }}</span>
													</li>
												</ul>
											</div>


										
								
							
							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
							<div class="card-box height-100-p overflow-hidden">
								<div class="profile-tab height-100-p">
									<div class="tab height-100-p">
										<ul class="nav nav-tabs customtab" role="tablist">
											<li class="nav-item">
												<a
													class="nav-link active"
													data-toggle="tab"
													href="#timeline"
													role="tab"
													>Profile</a
												>
											</li>
										
											<li class="nav-item">
												<a
													class="nav-link"
													data-toggle="tab"
													href="#setting"
													role="tab"
													>Security</a
												>
											</li>

											<li class="nav-item">
												<a
													class="nav-link"
													data-toggle="tab"
													href="#passport"
													role="tab"
													>Passport</a
												>
											</li>

										</ul>
										<div class="tab-content">
											<!-- Timeline Tab start -->
											<div
												class="tab-pane fade show active"
												id="timeline"
												role="tabpanel"
											>
												<div class="profile-setting">
                                                    @if(session('message'))
                                                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between mt-3 mb-20" role="alert" style="background: linear-gradient(135deg, #eafaf1 0%, #dff5e6 100%); border: 1px solid #bfe5c9; border-radius: 12px; color: #0e3d1f; box-shadow: 0 8px 20px rgba(15, 82, 37, 0.08); padding: 14px 18px;">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-check-circle mr-2" style="color: #1f8f4d; font-size: 1.1rem;"></i>
                                                                <span style="font-weight: 500;">{{ session('message') }}</span>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: #0e3d1f; opacity: 1; font-size: 1.3rem; line-height: 1; margin-left: 12px;">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif

                                                      @if(session('error'))
                                                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between mt-3 mb-20" role="alert">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-exclamation-triangle mr-2" style="color: #dc3545; font-size: 1.1rem;"></i>
                                                                <span style="font-weight: 500;">{{ session('error') }}</span>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: #c71037; opacity: 1; font-size: 1.3rem; line-height: 1; margin-left: 12px;">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif
													<form action="{{route('update.profile')}}" method="POST" class="">
														@csrf
														<ul class="profile-edit-list row">
															<li class="weight-500 col-md-12">
																<h4 class=" h5 mb-20" style="color: #093411">
																	Edit Your Profile Information
																</h4>
																<div class="form-group">
																	<label>Full Name</label>
																	<input
																		class="form-control form-control-lg"
																		type="text" name = "name" value = "{{Auth::user()->name}}"
																	/>
                                                                   
																</div>
																<div class="form-group">
																	<label>Email</label>
																	<input
																		class="form-control form-control-lg"
																		type="text" name = "email" value = "{{Auth::user()->email}}"
																	/>
																</div>
																
																<div class="form-group">
																	<label>Phone Number</label>
																	<input
																		class="form-control form-control-lg date-picker"
																		type="text" name = "phone" value = "{{Auth::user()->phone}}"
																	/>
																</div>
																
																
																{{-- <div class="form-group">
																	<label>Address</label>
																	<input
																		class="form-control form-control-lg"
																		type="text" name = "address" value = "{{Auth::user()->address}}"
																	/>
																</div> --}}
																
																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn"
                                                                        style = "background-color: #093411; color: white;"
																		value="Save Changes"
																	/>
																</div>
															</li>
															
														</ul>
													</form>
												</div>
											</div>
											<!-- Timeline Tab End -->
										
											<!-- Setting Tab start -->
											<div
												class="tab-pane fade height-100-p"
												id="setting"
												role="tabpanel"
											>
													<div class="profile-setting">
													<form action="{{ route('update.password') }}" method="POST">
														@csrf
														<ul class="profile-edit-list row">
															<li class="weight-500 col-md-12">
																<h4 class=" h5 mb-20" style="color: #093411">
																	Change Your Password
																</h4>
																<div class="form-group">
																	<label>Old Password</label>
																	<input
																		class="form-control form-control-lg"
																		type="password" name = "current_password" placeholder = "********"
																	/>
                                                                           @error('current_password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
																</div>
																<div class="form-group">
																	<label>New Password</label>
																	<input
																		class="form-control form-control-lg"
																		type="password" name = "password"  placeholder = "**********"
																	/>

                                                                                                                  @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
																</div>
																
																<div class="form-group">
																	<label>Confirm Password</label>
																	<input
																		class="form-control form-control-lg"
																		type="password" name = "password_confirmation" placeholder = "**********"
																	/>
                                                                                                                  @error('password_confirmation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
																</div>
																
																
																
																
																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn"
                                                                        style = "background-color: #093411; color: white;"
																		value="Update Security"
																	/>
																</div>
															</li>
															
														</ul>
													</form>
												</div>
											</div>
											<!-- Setting Tab End -->

												<!-- Setting Tab start -->
											<div
												class="tab-pane fade height-100-p"
												id="passport"
												role="tabpanel"
											>
													<div class="profile-setting">
													<form action="" method="POST" enctype="multipart/form-data">
														@csrf
														<ul class="profile-edit-list row">
															<li class="weight-500 col-md-12">
																<h4 class="text-blue h5 mb-20">
																	Change Your Profile Image
																</h4>
																
																							<center>
																

    <img  src = "{{ asset('vendors/images/person.svg') }}" id = "im" class = "w3-circle w3-card-6" style = " width: 100px; height: 100px;" alt = "profile photo"  ><br><br> 
<div class="form-group">
    <input type="file" name="image" accept="image/*" id="fileid" style="text-align: center;" class=""  onchange="loadImageFileAsURL();"  /> 
   

																</div><br><br>

																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn btn-primary"
																		value="Upload Image"
																	/>
																</div>
</center>
																
																
																
																
																
																
																
															</li>
															
														</ul>
													</form>
												</div>
											</div>
											<!-- Setting Tab End -->



										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


@endsection






<!DOCTYPE html>

<html>

<head>

	<!-- Basic Page Info -->

	<meta charset="utf-8">

	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>



	<!-- Site favicon -->

	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">

	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">

	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">



	<!-- Mobile Specific Metas -->

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



	<!-- Google Font -->

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<!-- CSS -->

	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">



	<!-- Global site tag (gtag.js) - Google Analytics -->

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

	<script>

		window.dataLayer = window.dataLayer || [];

		function gtag(){dataLayer.push(arguments);}

		gtag('js', new Date());



		gtag('config', 'UA-119386393-1');

	</script>

</head>

<body>

	{{-- <div class="pre-loader">

		<div class="pre-loader-box">

			<div class="loader-logo"><img src="vendors/images/deskapp-logo.svg" alt=""></div>

			<div class='loader-progress' id="progress_div">

				<div class='bar' id='bar1'></div>

			</div>

			<div class='percent' id='percent1'>0%</div>

			<div class="loading-text">

				Loading...

			</div>

		</div>

	</div> --}}



	<div class="header">

		<div class="header-left">

			<div class="menu-icon dw dw-menu"></div>

			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>

			<div class="header-search">

				<form>

					<div class="form-group mb-0">

						<i class="dw dw-search2 search-icon"></i>

						<input type="text" class="form-control search-input" placeholder="Search Here">

						<div class="dropdown">

							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

								<i class="ion-arrow-down-c"></i>

							</a>

							

						</div>

					</div>

				</form>

			</div>

		</div>

		<div class="header-right">

			<div class="dashboard-setting user-notification">

				<div class="dropdown">

					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">

						<i class="dw dw-settings2"></i>

					</a>

				</div>

			</div>

			<div class="user-notification">

				<div class="dropdown">

					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

						<i class="icon-copy dw dw-notification"></i>

						<span class="badge notification-active"></span>

					</a>

					<div class="dropdown-menu dropdown-menu-right">

						<div class="notification-list mx-h-350 customscroll">

							<ul>

								<li>

									<a href="#">

										<img src="vendors/images/img.jpg" alt="">

										<h3>John Doe</h3>

										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>

									</a>

								</li>

								<li>

									<a href="#">

										<img src="vendors/images/photo1.jpg" alt="">

										<h3>Lea R. Frith</h3>

										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>

									</a>

								</li>

								<li>

									<a href="#">

										<img src="vendors/images/photo2.jpg" alt="">

										<h3>Erik L. Richards</h3>

										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>

									</a>

								</li>

								<li>

									<a href="#">

										<img src="vendors/images/photo3.jpg" alt="">

										<h3>John Doe</h3>

										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>

									</a>

								</li>

								<li>

									<a href="#">

										<img src="vendors/images/photo4.jpg" alt="">

										<h3>Renee I. Hansen</h3>

										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>

									</a>

								</li>

								<li>

									<a href="#">

										<img src="vendors/images/img.jpg" alt="">

										<h3>Vicki M. Coleman</h3>

										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>

									</a>

								</li>

							</ul>

						</div>

					</div>

				</div>

			</div>

			<div class="user-info-dropdown">

				<div class="dropdown">

					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">

						<span class="user-icon">

							<img src="vendors/images/photo1.jpg" alt="">

						</span>

						<span class="user-name">Ross C. Lopez</span>

					</a>

					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>

						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>

						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>

						<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>

					</div>

				</div>

			</div>

			

		</div>

	</div>



	<div class="right-sidebar">

		<div class="sidebar-title">

			<h3 class="weight-600 font-16 text-blue">

				Layout Settings

				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>

			</h3>

			<div class="close-sidebar" data-toggle="right-sidebar-close">

				<i class="icon-copy ion-close-round"></i>

			</div>

		</div>

		<div class="right-sidebar-body customscroll">

			<div class="right-sidebar-body-content">

				<h4 class="weight-600 font-18 pb-10">Header Background</h4>

				<div class="sidebar-btn-group pb-30 mb-10">

					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>

					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>

				</div>



				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>

				<div class="sidebar-btn-group pb-30 mb-10">

					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>

					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>

				</div>



				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>

				<div class="sidebar-radio-group pb-10 mb-10">

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">

						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>

					</div>

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">

						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>

					</div>

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">

						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>

					</div>

				</div>



				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>

				<div class="sidebar-radio-group pb-30 mb-10">

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">

						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>

					</div>

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">

						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>

					</div>

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">

						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>

					</div>

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">

						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>

					</div>

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">

						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>

					</div>

					<div class="custom-control custom-radio custom-control-inline">

						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">

						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>

					</div>

				</div>



				<div class="reset-options pt-30 text-center">

					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>

				</div>

			</div>

		</div>

	</div>



	<div class="left-side-bar">

		<div class="brand-logo">

			<a href="index.html">

				<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">

				<img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">

			</a>

			<div class="close-sidebar" data-toggle="left-sidebar-close">

				<i class="ion-close-round"></i>

			</div>

		</div>

		<div class="menu-block customscroll">

			<div class="sidebar-menu">

				<ul id="accordion-menu">

					<li >

						<a href="javascript:;" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>

						</a>

						

					</li>

					<li>

						<a href="{{ route('agents.index') }}" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-group"></span><span class="mtext">Registered Agent</span>

						</a>

					</li>

                  

					<li>

						<a href="{{ route('properties.index') }}" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-list"></span><span class="mtext">View Property</span>

						</a>

					</li>

                    <li>

						<a href="{{ route('properties.create') }}" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-add"></span><span class="mtext">Add Property</span>

						</a>

					</li>



                    <li>

						<a href="{{ route('notification.index') }}" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-notification"></span><span class="mtext">Notification</span>

						</a>

					</li>



                    <li>

						<a href="{{ route('notification.create') }}" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-message-1"></span><span class="mtext">Send Notification</span>

						</a>

					</li>



                     <li>

						<a href="calendar.html" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-settings"></span><span class="mtext">Settings</span>

						</a>

					</li>



                    



                     <li>

						<a href="{{ route('admin.profile') }}" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-user"></span><span class="mtext">Profile</span>

						</a>

					</li>

					

					



					<li>

						<div class="dropdown-divider"></div>

					</li>

					<li>

						<div class="sidebar-small-cap">Extra</div>

					</li>

					

					<li>

						<a href="" target="_blank" class="dropdown-toggle no-arrow">

							<span class="micon dw dw-logout"></span>

							<span class="mtext">Logout</span>

						</a>

					</li>

				</ul>

			</div>

		</div>

	</div>

	<div class="mobile-menu-overlay"></div>



    @yield('content')





    <!-- js -->

		<script src="{{ asset('vendors/scripts/core.js') }}"></script>

	<script src="{{ asset('vendors/scripts/script.min.js') }}"></script>

	<script src="{{ asset('vendors/scripts/process.js') }}"></script>

	<script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/') }}/dataTables.responsive.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

	<!-- buttons for Export datatable -->

	<script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>

	<script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>

	<!-- Datatable Setting js -->

	<script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>

</body>

</html>

improve this design