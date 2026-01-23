<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/logo.jpg')}}" class="main-logo" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/logo.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>
							<span class="mb-0 text-muted">{{ auth()->user()->getRoleNames()->first()  }}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">Users Managment</li>
					<li class="slide">
                    @can("roles_view")

                        <a class="side-menu__item" href="{{ route('roles.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
                                <path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/>
                                <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
                            </svg>
                            <span class="side-menu__label">الادوار والصلاحيات</span>
                            {{-- <span class="badge badge-success side-badge">1</span> --}}
                        </a>
                    @endcan

					</li>
                    <li class="slide">
                        @can('users_view')
                            <a class="side-menu__item" href="{{ route('users.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                <span class="side-menu__label">المستخدمين</span>
                            </a>
                        @endcan
                    </li>

                    <li class="side-item side-item-category">Valuation Management</li>

                    <li class="slide">
                        @can('categories_view')
                            <a class="side-menu__item" href="{{ route('categories.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/>
                                </svg>
                                <span class="side-menu__label">الفئات</span>
                            </a>
                        @endcan
                    </li>
                    <li class="slide">
                        @can('sliders_view')
                            <a class="side-menu__item" href="{{ route('products.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M4 6h16v12H4zM6 8h12v8H6z"/>
                                </svg>
                                <span class="side-menu__label">المنتجات</span>
                            </a>
                        @endcan
                    </li>

                    <li class="side-item side-item-category">Content Management</li>

                    <li class="slide">
                        @can('sliders_view')
                            <a class="side-menu__item" href="{{ route('sliders.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M4 6h16v12H4zM6 8h12v8H6z"/>
                                </svg>
                                <span class="side-menu__label">السلايدر</span>
                            </a>
                        @endcan
                    </li>
                    
                    

                    <li class="slide">
                        @can('features_view')
                            <a class="side-menu__item" href="{{ route('features.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M5 4h14v4H5zm0 6h14v4H5zm0 6h14v4H5z"/>
                                </svg>
                                <span class="side-menu__label">مميزات السلايدر</span>
                            </a>
                        @endcan
                     </li>
                     <li class="slide">

                        @can('faqs_view')
                            <a class="side-menu__item" href="{{ route('faqs.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M5 4h14v4H5zm0 6h14v4H5zm0 6h14v4H5z"/>
                                </svg>
                                <span class="side-menu__label">الاسئلة الشائعة</span>
                            </a>
                        @endcan
                     </li>
                     <li class="slide">
                        @can('exclusive-distributors_view')
                            <a class="side-menu__item" href="{{ route('exclusive-distributors.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M5 4h14v4H5zm0 6h14v4H5zm0 6h14v4H5z"/>
                                </svg>
                                <span class="side-menu__label">الوكلاء الحصريون</span>
                            </a>
                        @endcan
                    </li>

                     <li class="slide">
                        @can('company-details_view')
                            <a class="side-menu__item" href="{{ route('company-details.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M5 4h14v4H5zm0 6h14v4H5zm0 6h14v4H5z"/>
                                </svg>
                                <span class="side-menu__label">عن الشركة</span>
                            </a>
                        @endcan
                    </li>

                     <li class="slide">
                        @can('company-sections_view')
                            <a class="side-menu__item" href="{{ route('company-sections.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M5 4h14v4H5zm0 6h14v4H5zm0 6h14v4H5z"/>
                                </svg>
                                <span class="side-menu__label">مميزات الشركة</span>
                            </a>
                        @endcan
                    </li>
                    <li class="slide">
                        @can('contact_us_view')
                            <a class="side-menu__item" href="{{ route('admin.contact.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                                <span class="side-menu__label">رسائل اتصل بنا</span>
                            </a>
                        @endcan
                    </li>

                    <li class="slide">
                        @can('blogs_view')
                            <a class="side-menu__item" href="{{ route('blogs.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                                <span class="side-menu__label">المقالات</span>
                            </a>
                        @endcan
                    </li>

                    <li class="slide">
                        @can('settings_view')
                            <a class="side-menu__item" href="{{ route('settings.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 
                                            4-1.79 4-4-1.79-4-4-4zm0-6c-1.1 0-2 .9-2 2v1.09
                                            c-1.2.21-2.33.64-3.34 1.24l-.77-.77c-.39-.39-1.02-.39-1.41 0s-.39 1.02 0 1.41l.77.77
                                            c-.6 1.01-1.03 2.14-1.24 3.34H2c-1.1 0-2 .9-2 2s.9 2 2 2h1.09c.21 1.2.64 2.33 1.24 3.34l-.77.77
                                            c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l.77-.77c1.01.6 2.14 1.03 3.34 1.24V20c0 1.1.9 2 2 2s2-.9 2-2v-1.09
                                            c1.2-.21 2.33-.64 3.34-1.24l.77.77c.39.39 1.02.39 1.41 0s.39-1.02 0-1.41l-.77-.77
                                            c.6-1.01 1.03-2.14 1.24-3.34H22c1.1 0 2-.9 2-2s-.9-2-2-2h-1.09c-.21-1.2-.64-2.33-1.24-3.34l.77-.77
                                            c.39-.39.39-1.02 0-1.41-.39-.39-1.02-.39-1.41 0l-.77.77c-1.01-.6-2.14-1.03-3.34-1.24V4c0-1.1-.9-2-2-2z"/>
                                </svg>
                                <span class="side-menu__label">الإعدادات</span>
                            </a>
                        @endcan
                    </li>
                    <li class="slide">
                        @can('services_view')
                            <a class="side-menu__item" href="{{ route('services.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path d="M5 4h14v4H5zm0 6h14v4H5zm0 6h14v4H5z"/>
                                </svg>
                                <span class="side-menu__label">الخدمات</span>
                            </a>
                        @endcan
                    </li>


				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
