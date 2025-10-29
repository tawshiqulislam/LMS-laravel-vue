<div class="tp-sidebar-area tp-navy-blue-bg">
    <div class="tp-deashboard-head position-relative">
        <a href="{{ route('org.dashboard') }}" class="tp-deashboard-logo mb-16">
            <img src="{{ $app_setting['logo'] ?? 'https://placehold.co/500x120' }}" alt="">
        </a>
        <span class="tp-deashboard-close-icon d-md-block d-lg-none">
            <i class="fal fa-times"></i>
        </span>
    </div>
    <div class="tp-sidebar-menu">
        <nav>
            <ul>
                <li
                    class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('org.dashboard', 'org.profile') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="tp-dropdown-toggle">
                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                            <img src="{{ asset('org_assets') }}/images/sidebar/chart-bar.svg" alt=""
                                loading="lazy">
                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Dashboard') }}</span>
                        </div>
                        <i class="far fa-angle-right dropdown-icon"></i>
                    </a>
                    <ul class="tp-dropdown__menu tpfadeInLeft-2">
                        <li class="{{ request()->routeIs('org.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('org.dashboard') }}">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('My Home') }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('org.profile') ? 'active' : '' }}">
                            <a href="{{ route('org.profile', auth()->user()?->id) }}">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('My Profile') }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('org.plan.*') || request()->routeIs('org.pricing.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="tp-dropdown-toggle">
                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                            <img src="{{ asset('org_assets') }}/images/menu/subscription_plan.svg" alt=""
                                loading="lazy">
                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Plan & Billing') }}</span>
                        </div>
                        <i class="far fa-angle-right dropdown-icon"></i>
                    </a>
                    <ul class="tp-dropdown__menu tpfadeInLeft-2">
                        <li class="{{ request()->routeIs('org.pricing.index') ? 'active' : '' }}">
                            <a href="{{ route('org.pricing.index') }}">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Choose Plan') }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('org.plan.index') ? 'active' : '' }}">
                            <a href="{{ route('org.plan.index') }}">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Current Plan') }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('org.plan.billing.history') ? 'active' : '' }}">
                            <a href="{{ route('org.plan.billing.history') }}">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <span
                                        class="tp-sidebar-menu-list-title ml-7">{{ __('Transaction History') }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                @if ($app_setting['organization']?->domain == request()->getSchemeAndHttpHost())

                    @canany(['category.index', 'course.index', 'chapter.index'])
                        <li
                            class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('category.*', 'course.*', 'chapter.*') ? 'open' : '' }}">
                            <a href="javascript:void(0);" class="tp-dropdown-toggle">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <img src="{{ asset('org_assets/images/menu/book-open-text.svg') }}" alt=""
                                        loading="lazy">
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Course Management') }}</span>
                                </div>
                                <i class="far fa-angle-right dropdown-icon"></i>
                            </a>
                            <ul class="tp-dropdown__menu tpfadeInLeft-2">
                                <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                                    <a href="{{ route('category.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Category') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('course.*') ? 'active' : '' }}">
                                    <a href="{{ route('course.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Course') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('chapter.*') ? 'active' : '' }}">
                                    <a href="{{ route('chapter.select_course') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Chapter') }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['exam.select_course', 'quiz.select_course'])
                        <li class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('exam.*', 'quiz.*') ? 'open' : '' }}">
                            <a href="javascript:void(0);" class="tp-dropdown-toggle">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <img class="menu-icon" src="{{ asset('org_assets/images/menu/pencil-paper.svg') }}"
                                        alt="icon" loading="lazy" />
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Assessment Management') }}</span>
                                </div>
                                <i class="far fa-angle-right dropdown-icon"></i>
                            </a>
                            <ul class="tp-dropdown__menu tpfadeInLeft-2">
                                <li class="{{ request()->routeIs('exam.*') ? 'active' : '' }}">
                                    <a href="{{ route('exam.select_course') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Exam') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('quiz.*') ? 'active' : '' }}">
                                    <a href="{{ route('quiz.select_course') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Quiz') }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['coupon.index', 'coupon.create'])
                        <li class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('coupon.*') ? 'open' : '' }}">
                            <a href="javascript:void(0);" class="tp-dropdown-toggle">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <img class="menu-icon" src="{{ asset('org_assets/images/menu/coupon-percent.svg') }}"
                                        alt="icon" loading="lazy" />
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Coupon Management') }}</span>
                                </div>
                                <i class="far fa-angle-right dropdown-icon"></i>
                            </a>
                            <ul class="tp-dropdown__menu tpfadeInLeft-2">
                                <li class="{{ request()->routeIs('coupon.index', 2) ? 'active' : '' }}">
                                    <a href="{{ route('coupon.index', 2) }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Coupon List') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('coupon.create', 3) ? 'active' : '' }}">
                                    <a href="{{ route('coupon.create', 3) }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Add New Coupon') }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['instructor.index', 'instructor.create'])
                        <li class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('instructor.*') ? 'open' : '' }}">
                            <a href="javascript:void(0);" class="tp-dropdown-toggle">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <img class="menu-icon" src="{{ asset('org_assets/images/menu/teacher.svg') }}"
                                        alt="icon" loading="lazy" />
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Faculty Management') }}</span>
                                </div>
                                <i class="far fa-angle-right dropdown-icon"></i>
                            </a>
                            <ul class="tp-dropdown__menu tpfadeInLeft-2">
                                <li
                                    class="{{ request()->routeIs('instructor.index', 'instructor.edit') ? 'active' : '' }}">
                                    <a href="{{ route('instructor.index', 2) }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Instructor List') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('instructor.create', 1) ? 'active' : '' }}">
                                    <a href="{{ route('instructor.create', 1) }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Add New Instructor') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('instructor.featured', 3) ? 'active' : '' }}">
                                    <a href="{{ route('instructor.featured', 3) }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Featured Instructors') }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcanany

                    <li
                        class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('user.*', 'enrollment.*', 'review.*', 'transaction.*') ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="tp-dropdown-toggle">
                            <div class="tp-sidebar-menu-left d-flex align-items-center">
                                <img class="menu-icon" src="{{ asset('org_assets/images/menu/users-group.svg') }}"
                                    alt="icon" loading="lazy" />
                                <span class="tp-sidebar-menu-list-title ml-7">{{ __('Student Records') }}</span>
                            </div>
                            <i class="far fa-angle-right dropdown-icon"></i>
                        </a>
                        <ul class="tp-dropdown__menu tpfadeInLeft-2">
                            @can('user.index')
                                <li class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
                                    <a href="{{ route('user.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Student List') }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('enrollment.index')
                                <li class="{{ request()->routeIs('enrollment.*') ? 'active' : '' }}">
                                    <a href="{{ route('enrollment.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Total Enrolled') }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('review.index')
                                <li class="{{ request()->routeIs('review.*') ? 'active' : '' }}">
                                    <a href="{{ route('review.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Student Review') }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @if (auth()->user()->organization &&
                                    auth()->user()->organization->domain != null &&
                                    auth()->user()->organization->domain == request()->getSchemeAndHttpHost())
                                @can('transaction.index')
                                    <li class="{{ request()->routeIs('transaction.*') ? 'active' : '' }}">
                                        <a href="{{ route('transaction.index') }}">
                                            <div class="tp-sidebar-menu-left d-flex align-items-center">
                                                <span
                                                    class="tp-sidebar-menu-list-title ml-7">{{ __('Transaction History') }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </li>
                    <li
                        class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('testimonial.*', 'contact.*') ? 'open' : '' }}">
                        <a href="#" class="tp-dropdown-toggle">
                            <div class="tp-sidebar-menu-left d-flex align-items-center">
                                <img class="menu-icon" src="{{ asset('org_assets/images/menu/testimonial.svg') }}"
                                    alt="icon" loading="lazy" />
                                <span class="tp-sidebar-menu-list-title ml-7">{{ __('Client Feedback') }}</span>
                            </div>
                            <i class="far fa-angle-right dropdown-icon"></i>
                        </a>
                        <ul class="tp-dropdown__menu tpfadeInLeft-2">
                            @can('testimonial.index')
                                <li class="{{ request()->routeIs('testimonial.*') ? 'active' : '' }}">
                                    <a href="{{ route('testimonial.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Feedback') }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('contact.index')
                                <li class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">
                                    <a href="{{ route('contact.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Support & Queries') }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    @can('page.index')
                        <li class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('page.*') ? 'open' : '' }}">
                            <a href="javascript:void(0);" class="tp-dropdown-toggle">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <img class="menu-icon" src="{{ asset('org_assets/images/menu/page.svg') }}"
                                        alt="icon" loading="lazy" />
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Legal Pages') }}</span>
                                </div>
                                <i class="far fa-angle-right dropdown-icon"></i>
                            </a>
                            <ul class="tp-dropdown__menu tpfadeInLeft-2">
                                <li
                                    class="{{ request()->is('organizations/page/edit/about_us', 'admin/page/edit/about_us') ? 'active' : '' }}">
                                    <a href="{{ route('page.edit', 'about_us') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7"> {{ __('About Us') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('organizations/page/edit/contact_us', 'admin/page/edit/contact_us') ? 'active' : '' }}">
                                    <a href="{{ route('page.edit', 'contact_us') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('Contact Us') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('organizations/page/edit/faq', 'admin/page/edit/faq') ? 'active' : '' }}">
                                    <a href="{{ route('page.edit', 'faq') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('FAQ') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('organizations/page/edit/privacy_policy', 'admin/page/edit/privacy_policy') ? 'active' : '' }}">
                                    <a href="{{ route('page.edit', 'privacy_policy') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Privacy Policy') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('organizations/page/edit/terms_and_conditions', 'admin/page/edit/terms_and_conditions') ? 'active' : '' }}">
                                    <a href="{{ route('page.edit', 'terms_and_conditions') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Terms & Conditions') }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('organizations/page/edit/refund_policy', 'admin/page/edit/refund_policy') ? 'active' : '' }}">
                                    <a href="{{ route('page.edit', 'refund_policy') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Refund Policy') }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('banner.index')
                        <li
                            class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('banner.*') ? 'open active' : '' }}">
                            <a href="javascript:void(0);" class="tp-dropdown-toggle">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <img class="menu-icon" src="{{ asset('org_assets') }}/images/menu/banner.svg"
                                        alt="icon" loading="lazy" />
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Offer Banner') }}</span>
                                </div>
                                <i class="far fa-angle-right dropdown-icon"></i>
                            </a>
                            <ul class="tp-dropdown__menu tpfadeInLeft-2">
                                <li class="{{ request()->routeIs('banner.*') ? 'active' : '' }}">
                                    <a href="{{ route('banner.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Show & Create') }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    <li
                        class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('org.site.setting.*', 'certificate.*') ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="tp-dropdown-toggle">
                            <div class="tp-sidebar-menu-left d-flex align-items-center">
                                <img class="menu-icon" src="{{ asset('org_assets/images/menu/settings.svg') }}"
                                    alt="icon" loading="lazy" />
                                <span class="tp-sidebar-menu-list-title ml-7">{{ __('General Settings') }}</span>
                            </div>
                            <i class="far fa-angle-right dropdown-icon"></i>
                        </a>
                        <ul class="tp-dropdown__menu tpfadeInLeft-2">
                            <li class="{{ request()->routeIs('org.site.setting.*') ? 'active' : '' }}">
                                <a href="{{ route('org.site.setting.index') }}">
                                    <div class="tp-sidebar-menu-left d-flex align-items-center">
                                        <span
                                            class="tp-sidebar-menu-list-title ml-7">{{ __('System Settings') }}</span>
                                    </div>
                                </a>
                            </li>
                            @can('certificate.index')
                                <li class="{{ request()->routeIs('certificate.*') ? 'active' : '' }}">
                                    <a href="{{ route('certificate.index') }}">
                                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                                            <span
                                                class="tp-sidebar-menu-list-title ml-7">{{ __('Certificates Settings') }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <li class="tp-dropdown__menu-item mb-7 {{ request()->routeIs('org.dns.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="tp-dropdown-toggle">
                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                            <img src="{{ asset('org_assets') }}/images/menu/dns.svg" alt="Sidebar Logo"
                                loading="lazy" />
                            <span class="tp-sidebar-menu-list-title ml-7">{{ __('DNS Configuration') }}</span>
                        </div>
                        <i class="far fa-angle-right dropdown-icon"></i>
                    </a>
                    <ul class="tp-dropdown__menu tpfadeInLeft-2">
                        <li class="{{ request()->routeIs('org.dns.*') ? 'active' : '' }}">
                            <a href="{{ route('org.dns.index') }}">
                                <div class="tp-sidebar-menu-left d-flex align-items-center">
                                    <span class="tp-sidebar-menu-list-title ml-7">{{ __('Setup Domain') }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="tp-dropdown__menu-item mb-7 bg-white mt-5">
                    <a href="{{ route('admin.logout') }}">
                        <div class="tp-sidebar-menu-left d-flex align-items-center">
                            <img class="menu-icon" src="{{ asset('org_assets/images/menu/log-out.svg') }}"
                                alt="icon" loading="lazy" />
                            <span class="tp-sidebar-menu-list-title ml-7 text-danger">{{ __('Logout') }}</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
