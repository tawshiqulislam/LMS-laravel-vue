<style>
    .countMessage {
        position: absolute;
        top: -5px;
        left: 15px;
        width: 15px;
        height: 15px;
        border-radius: 50px;
        background: #ff0000;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 8px;
        text-indent: 0;
    }
</style>

@php
    $countPendingOrganizations = 0;
    $count = 0;
    if (auth()->user()->hasRole('admin') || auth()->user()->is_admin || auth()->user()->is_root) {
        $count = \App\Models\ContactMessage::where('state', 0)->count();
        $countPendingOrganizations = \App\Models\Organization::whereHas('user', function ($query) {
            $query->where('email_verified_at', null);
        })->count();
    }
@endphp

<!--Sidebar-Menu-Section-->
<div class="app-sidebar sidebar-shadow">
    <div class="scrollbar-sidebar">

        <div class="branding-logo">
            <a href="{{ auth()->user()->hasRole('admin') ? '/admin' : '/admin/dashboard"' }}" target="_blank"><img
                    src="{{ $app_setting['logo'] }}" alt="logo">
            </a>
        </div>


        <div class="branding-logo-forMobile mb-4">
            <a href="{{ auth()->user()->hasRole('admin') ? '/admin' : '/admin/dashboard"' }}" target="_blank"><img
                    src="{{ $app_setting['logo'] }}" alt=""></a>
        </div>
        <div class="app-sidebar-inner border-top">
            <ul class="vertical-nav-menu">


                @if (Auth::user()->hasRole('admin'))
                    {{-- dashboard start --}}
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Dashboard') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/home-roof.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>
                @elseif(Auth::user()->hasRole('instructor'))
                    {{-- dashboard start --}}
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Dashboard') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin') ? 'active' : '' }}"
                            href="{{ route('instructor.dashboard') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/home-roof.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>
                @elseif(Auth::user()->hasRole('organization'))
                    {{-- dashboard start --}}
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Dashboard') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin') ? 'active' : '' }}"
                            href="{{ route('org.dashboard') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/home-roof.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>
                @endif
                {{-- dashboard start --}}


                @can('plan.index')
                    {{-- subscription plan start --}}
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Subscriptions') }}</span>
                    </li>

                    <li>
                        <a class="menu {{ request()->is('admin/plans*') ? 'active' : '' }}" data-bs-toggle="collapse"
                            href="#ordersSubscription">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/subscription_plan.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Plan Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/plans*') ? 'show' : '' }}"
                            id="ordersSubscription">
                            <div class="listBar">
                                <a href="{{ route('plan.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/plans/list') || request()->is('admin/plans/edit/*') ? 'active' : '' }}">
                                    {{ __('Plan List') }}
                                </a>

                                @can('plan.create')
                                    <a href="{{ route('plan.create') }}"
                                        class="subMenu hasCount {{ request()->is('admin/plans/create*') ? 'active' : '' }}">
                                        {{ __('Create New Plan') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcan

                @can('subscriber.index')
                    <li>
                        <a class="menu {{ request()->is('admin/subscribers/*') ? 'active' : '' }}"
                            href="{{ route('subscriber.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/medal.svg') }}" alt="icon"
                                    loading="lazy" />
                                {{ __('Subscriber Management') }}
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- subscription plan end --}}

                {{-- course start --}}

                @canany(['category.index', 'course.index', 'chapter.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Course') }}</span>
                    </li>
                    <li>
                        <a class="menu
                            {{ request()->is(
                                'admin/category/*',
                                'admin/course/*',
                                'admin/chapter/*',
                                'organizations/category/*',
                                'organizations/course/*',
                                'organizations/chapter/*',
                            )
                                ? 'active'
                                : '' }}"
                            data-bs-toggle="collapse" href="#ordersCourse">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/book-open-text.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Course Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse
                        {{ request()->is('admin/category/*', 'admin/course/*', 'admin/chapter/*', 'organizations/category/*', 'organizations/course/*', 'organizations/chapter/*') ? 'show' : '' }}"
                            id="ordersCourse">
                            <div class="listBar">
                                @can('category.index')
                                    <a href="{{ route('category.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/category/*', 'organizations/category/*') ? 'active' : '' }}">
                                        {{ __('Category') }}
                                    </a>
                                @endcan
                                @can('course.index')
                                    <a href="{{ route('course.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/course/*', 'organizations/course/*') ? 'active' : '' }}">
                                        {{ __('Course') }}
                                    </a>
                                @endcan
                                @can('chapter.index')
                                    <a href="{{ route('chapter.select_course') }}"
                                        class="subMenu hasCount {{ request()->is('admin/chapter/*', 'organizations/chapter/*') ? 'active' : '' }}">
                                        {{ __('Chapter') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- course end --}}

                {{-- exam start --}}
                @canany(['exam.select_course', 'quiz.select_course'])
                    <li>
                        <a class="menu {{ request()->is('admin/exam/*', 'admin/quiz/*', 'organizations/exam/*', 'organizations/quiz/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersExam">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/pencil-paper.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Exam Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/exam/*', 'admin/quiz/*', 'organizations/exam/*', 'organizations/quiz/*') ? 'show' : '' }}"
                            id="ordersExam">
                            <div class="listBar">
                                @can('exam.select_course')
                                    <a href="{{ route('exam.select_course') }}"
                                        class="subMenu hasCount {{ request()->is('admin/exam*', 'organizations/exam/*') ? 'active' : '' }}">
                                        {{ __('Exam') }}
                                    </a>
                                @endcan
                                @can('quiz.select_course')
                                    <a href="{{ route('quiz.select_course') }}"
                                        class="subMenu hasCount {{ request()->is('admin/quiz/*', 'organizations/quiz/*') ? 'active' : '' }}">
                                        {{ __('Quiz') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- exam end --}}

                {{-- coupon start --}}
                @canany(['coupon.index', 'coupon.create'])
                    <li>
                        <a class="menu {{ request()->is('admin/coupon/*', 'organizations/coupon/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersCoupon">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/coupon-percent.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Coupon Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/coupon/*', 'organizations/coupon/*') ? 'show' : '' }}"
                            id="ordersCoupon">
                            <div class="listBar">
                                @can('coupon.index')
                                    <a href="{{ route('coupon.index', 2) }}"
                                        class="subMenu hasCount {{ request()->is('admin/coupon/list', 'organizations/coupon/list') ? 'active' : '' }}">
                                        {{ __('Coupon List') }}
                                    </a>
                                @endcan
                                @can('coupon.create')
                                    <a href="{{ route('coupon.create', 3) }}"
                                        class="subMenu hasCount {{ request()->is('admin/coupon/create', 'organizations/coupon/list') ? 'active' : '' }}">
                                        {{ __('New Coupon') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- coupon end --}}

                {{-- banner start --}}

                @can('banner.index')
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Banner') }}</span>
                    </li>

                    <li>
                        <a class="menu {{ request()->is('admin/banners*') ? 'active' : '' }}"
                            href="{{ route('banner.index') }}">
                            <span class="position-relative">
                                <img class="menu-icon" src="{{ asset('assets/images/menu/banner.svg') }}" alt="icon"
                                    loading="lazy" />
                                {{ __('Banner Management') }}
                            </span>
                        </a>
                    </li>
                @endcan


                {{-- banner end --}}

                @canany(['user.index', 'enrollment.index', 'review.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Student') }}</span>
                    </li>
                @endcanany

                {{-- enrollment start --}}
                @canany(['enrollment.index', 'review.index'])
                    <li>
                        <a class="menu {{ request()->is('admin/enrollment/*', 'admin/review/*', 'organizations/review/*', 'organizations/enrollment/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersEnrollmentReview">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/students.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Enrollment Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/enrollment/*', 'admin/review/*', 'organizations/review/*', 'organizations/enrollment/*') ? 'show' : '' }}"
                            id="ordersEnrollmentReview">
                            <div class="listBar">
                                @can('enrollment.index')
                                    <a href="{{ route('enrollment.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/enrollment/*', 'organizations/enrollment/*') ? 'active' : '' }}">
                                        {{ __('Enrollment') }}
                                    </a>
                                @endcan
                                @can('review.index')
                                    <a href="{{ route('review.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/review/*', 'organizations/review/*') ? 'active' : '' }}">
                                        {{ __('Review') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- enrollment end --}}

                {{-- student start --}}
                @canany(['user.index'])
                    <li>
                        <a class="menu {{ request()->is('admin/user/*', 'organizations/user/*') != request()->is('admin/user/edit/*', 'organizations/user/edit/*') ? 'active' : '' }}"
                            href="{{ route('user.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/users-group.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Students Management') }}
                            </span>
                        </a>
                    </li>
                @endcanany
                {{-- student end --}}


                {{-- instructor start --}}
                @canany(['instructor.index', 'instructor.create'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Instructor') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin/instructor/*', 'organizations/instructor/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersInstructor">
                            <span>
                                <img style="text-primary" class="menu-icon"
                                    src="{{ asset('assets/images/menu/teacher 01.svg') }}" alt="icon"
                                    loading="lazy" />
                                {{ __('Instructor Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/instructor/*', 'organizations/instructor/*') ? 'show' : '' }}"
                            id="ordersInstructor">
                            <div class="listBar">
                                @can('instructor.index')
                                    <a href="{{ route('instructor.index', 2) }}"
                                        class="subMenu hasCount {{ request()->is('admin/instructor/list/*', 'admin/instructor/edit/*', 'organizations/instructor/list/*', 'organizations/instructor/edit/*') ? 'active' : '' }}">
                                        {{ __('Instructor List') }}
                                    </a>
                                @endcan
                                @can('instructor.create')
                                    <a href="{{ route('instructor.create', 1) }}"
                                        class="subMenu hasCount {{ request()->is('admin/instructor/create', 'organizations/instructor/create') ? 'active' : '' }}">
                                        {{ __('New Instructor') }}
                                    </a>
                                @endcan
                                @can('instructor.featured')
                                    <a href="{{ route('instructor.featured', 3) }}"
                                        class="subMenu hasCount {{ request()->is('admin/instructor/featured/*', 'organizations/instructor/featured/*') ? 'active' : '' }}">
                                        {{ __('Featured Instructors') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- instructor end --}}

                {{-- Organization start --}}
                @canany(['organizations.index', 'organizations.plan.index', 'organizations.subscribers'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Companies') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->routeIs('organizations.*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersOrganization">
                            <span class="position-relative">
                                <img style="text-primary" class="menu-icon"
                                    src="{{ asset('assets/images/menu/org.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Organizations') }}
                                @if ($countPendingOrganizations > 0)
                                    <div class="countMessage">
                                        {{ $countPendingOrganizations }}
                                    </div>
                                @endif
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->routeIs('organizations.*') ? 'show' : '' }}"
                            id="ordersOrganization">
                            <div class="listBar">
                                @can('organizations.index')
                                    <a href="{{ route('organizations.index') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.index', 'organizations.edit') ? 'active' : '' }}">
                                        {{ __('Organization List') }}
                                    </a>
                                @endcan
                                @can('organizations.plan.index')
                                    <a href="{{ route('organizations.plan.index') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.plan.index', 'organizations.plan.edit') ? 'active' : '' }}">
                                        {{ __('DNS Plan History') }}
                                    </a>
                                @endcan
                                @can('organizations.plan.create')
                                    <a href="{{ route('organizations.plan.create') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.plan.create') ? 'active' : '' }}">
                                        {{ __('DNS Create Plan') }}
                                    </a>
                                @endcan
                                @can('organizations.subscribers')
                                    <a href="{{ route('organizations.subscribers') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.subscribers') ? 'active' : '' }}">
                                        {{ __('DNS Plan Subscribers') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- Organization end --}}

                {{-- transaction start --}}

                @canany(['transaction.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Payment & Transactions') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->routeIs('transaction.*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersTransaction">
                            <span class="position-relative">
                                <img class="menu-icon" src="{{ asset('assets/images/menu/invoice.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Account Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->routeIs('transaction.*') ? 'show' : '' }}"
                            id="ordersTransaction">
                            <div class="listBar">
                                <a href="{{ route('transaction.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('transaction.index') ? 'active' : '' }}">
                                    {{ __('Transactions') }}
                                </a>
                                <a href="{{ route('transaction.failed') }}"
                                    class="subMenu hasCount {{ request()->routeIs('transaction.failed') ? 'active' : '' }}">
                                    {{ __('Failed Transactions') }}
                                </a>
                                <a href="{{ route('transaction.courses') }}"
                                    class="subMenu hasCount {{ request()->routeIs('transaction.courses') ? 'active' : '' }}">
                                    {{ __('Course Purchases') }}
                                </a>
                                <a href="{{ route('transaction.invoices') }}"
                                    class="subMenu hasCount {{ request()->routeIs('transaction.invoices') ? 'active' : '' }}">
                                    {{ __('Invoice Wise Purchases') }}
                                </a>
                                <a href="{{ route('transaction.subscriptions') }}"
                                    class="subMenu hasCount {{ request()->routeIs('transaction.subscriptions') ? 'active' : '' }}">
                                    {{ __('Subscription Purchases') }}
                                </a>
                                <a href="{{ route('transaction.dns.plans') }}"
                                    class="subMenu hasCount {{ request()->routeIs('transaction.dns.plans') ? 'active' : '' }}">
                                    {{ __('DNS Plan Wise Purchases') }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endcanany

                {{-- transaction end --}}

                <li class="menu-divider">
                    <span class="menu-title">{{ __('Query & Profile Management') }}</span>
                </li>

                {{-- testimonial start --}}
                @can('testimonial.index')
                    <li>
                        <a class="menu {{ request()->is('admin/testimonial/*', 'organizations/testimonial/*') ? 'active' : '' }}"
                            href="{{ route('testimonial.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/testimonial.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Testimonial') }}
                            </span>
                        </a>
                    </li>
                @endcan

                {{-- testimonial end --}}

                {{-- newsletter start --}}
                @can('newslatter.index')
                    <li>
                        <a class="menu {{ request()->is('admin/newslatter/*', 'organizations/newslatter/*') ? 'active' : '' }}"
                            href="{{ route('newslatter.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/subscription.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Newslatter Subscribers') }}
                            </span>
                        </a>
                    </li>
                @endcan

                {{-- newsletter end --}}

                {{-- Notification start --}}
                @canany(['notification.index'])
                    <li>
                        <a class="menu {{ request()->is('admin/notification/*', 'organizations/notification/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#notificationManagement">
                            <span>
                                <img style="text-primary" class="menu-icon"
                                    src="{{ asset('assets/images/menu/bell-on.svg') }}" alt="icon"
                                    loading="lazy" />
                                {{ __('Notification Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/notification/*', 'organizations/notification/*') ? 'show' : '' }}"
                            id="notificationManagement">
                            <div class="listBar">
                                @can('notification.index')
                                    <a href="{{ route('notification.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/notification/list/*', 'organizations/notification/list/*') ? 'active' : '' }}">
                                        {{ __('Pre-defined Notification') }}
                                    </a>
                                @endcan
                                <a href="{{ route('notification.custom.index', ['user_scope_filter' => 'all']) }}"
                                    class="subMenu hasCount {{ request()->is('admin/notification/custom/*', 'organizations/notification/custom/*') ? 'active' : '' }}">
                                    {{ __('Custom Notification') }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- notification end --}}

                {{-- contact us start --}}
                @can('contact.index')
                    <li>
                        <a class="menu {{ request()->is('admin/contact/*', 'organizations/contact/*') ? 'active' : '' }}"
                            href="{{ route('contact.index') }}">
                            <span class="position-relative">
                                <img class="menu-icon" src="{{ asset('assets/images/menu/message.svg') }}"
                                    alt="icon" loading="lazy" />
                                @if ($count > 0)
                                    <div class="countMessage">
                                        {{ $count }}
                                    </div>
                                @endif
                                {{ __('Help & Support Queries') }}
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- contact us end --}}

                {{-- super admin start --}}
                @canany('admin.index')
                    {{-- <li>
                        <a class="menu {{ request()->is('admin/root*') ? 'active' : '' }}"
                            href="{{ route('admin.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/user-settings.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Super Admin') }}
                            </span>
                        </a>
                    </li> --}}
                    <li>
                        <a class="menu {{ request()->is('admin/root/*') ? 'active' : '' }}" data-bs-toggle="collapse"
                            href="#adminManagement">
                            <span>
                                <img style="text-primary" class="menu-icon"
                                    src="{{ asset('assets/images/menu/user-settings.svg') }}" alt="icon"
                                    loading="lazy" />
                                {{ __('Admin Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/root*') ? 'show' : '' }}"
                            id="adminManagement">
                            <div class="listBar">
                                <a href="{{ route('admin.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/root/sup-admin/list') ? 'active' : '' }}">
                                    {{ __('Super Admin') }}
                                </a>
                                <a href="{{ route('admin.assistant.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/root/assistant-admin/list') ? 'active' : '' }}">
                                    {{ __("Associate Admin's") }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- super admin end --}}


                {{-- profile start --}}
                @canany(['admin.profile'])
                    <li>
                        <a class="menu {{ request()->is('admin/profile/*', 'admin/user/edit/*', 'organizations/profile/*', 'organizations/user/edit/*') ? 'active' : '' }}"
                            href="{{ route('admin.profile') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/icon/user-square.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Profile') }}
                            </span>
                        </a>
                    </li>
                @endcanany
                {{-- profile End --}}

                {{-- Report start --}}
                @if (!auth()->user()->hasRole('admin') && !auth()->user()->is_admin && auth()->user()->hasRole('instructor'))
                    @canany(['report.index'])
                        <li>
                            <a class="menu {{ request()->is('admin/report/*', 'organizations/report/*') ? 'active' : '' }}"
                                href="{{ route('report.index', ['filter_type' => 'all', 'daterange' => now()->format('Y-m-d') . '_' . now()->format('Y-m-d')]) }}">
                                <span>
                                    <img class="menu-icon" src="{{ asset('assets/images/icon/chart-pie.svg') }}"
                                        alt="icon" loading="lazy" />
                                    {{ __('Report') }}
                                </span>
                            </a>
                        </li>
                    @endcanany
                @endif
                {{-- Report End --}}

                {{-- general setting start --}}
                <li class="menu-divider">
                    <span class="menu-title">{{ __('General Setting') }}</span>
                </li>

                <li>
                    <a class="menu {{ request()->is('admin/setting*', 'admin/certificate/*', 'admin/permission&role/*', 'admin/language/*', 'organizations/setting/*', 'organizations/certificate/*', 'organizations/permission&role/*', 'organizations/language/*') || request()->routeIs('server.index', 'setting.home.page.setup', 'setting.smtp.setup', 'setting.social.media.setup') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#settingManagement">
                        <span>
                            <img style="text-primary" class="menu-icon"
                                src="{{ asset('assets/images/menu/settings.svg') }}" alt="icon"
                                loading="lazy" />
                            {{ __('Settings Management') }}
                        </span>
                        <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                            class="downIcon" />
                    </a>
                    <div class="collapse dropdownMenuCollapse {{ request()->is('admin/setting*', 'admin/certificate/*', 'admin/permission&role/*', 'admin/language/*', 'organizations/setting/*', 'organizations/certificate/*', 'organizations/permission&role/*', 'organizations/language/*', 'admin/payment_gateway/*', 'organizations/payment_gateway/*') || request()->routeIs('server.index', 'setting.home.page.setup', 'setting.smtp.setup', 'setting.social.media.setup') ? 'show' : '' }}"
                        id="settingManagement">
                        <div class="listBar">
                            @can('setting.index')
                                <a href="{{ route('setting.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('setting.index') ? 'active' : '' }}">
                                    {{ __('Business Settings') }}
                                </a>
                                <a href="{{ route('setting.home.page.setup') }}"
                                    class="subMenu hasCount {{ request()->routeIs('setting.home.page.setup') ? 'active' : '' }}">
                                    {{ __('Site Settings') }}
                                </a>
                                <a href="{{ route('setting.smtp.setup') }}"
                                    class="subMenu hasCount {{ request()->routeIs('setting.smtp.setup') ? 'active' : '' }}">
                                    {{ __('SMTP Settings') }}
                                </a>
                                <a href="{{ route('setting.social.media.setup') }}"
                                    class="subMenu hasCount {{ request()->routeIs('setting.social.media.setup') ? 'active' : '' }}">
                                    {{ __('Social Media Settings') }}
                                </a>
                            @endcan
                            @can('certificate.index')
                                <a href="{{ route('certificate.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/certificate/*', 'organizations/certificate/*') ? 'active' : '' }}">
                                    {{ __('Certificate Configaration') }}
                                </a>
                            @endcan
                            @can('role.index')
                                <a href="{{ route('role.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/permission&role/*', 'organizations/permission&role/*') ? 'active' : '' }}">
                                    {{ __('Role & Permission') }}
                                </a>
                            @endcan
                            <a href="{{ route('language.index') }}"
                                class="subMenu hasCount {{ request()->is('admin/language/*', 'organizations/language/*') ? 'active' : '' }}">
                                {{ __('Language') }}
                            </a>
                            @can('server.index')
                                <a href="{{ route('server.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('server.index') ? 'active' : '' }}">
                                    {{ __('Server Configuration') }}
                                </a>
                            @endcan

                            @can('payment_gateway.index')
                                <a href="{{ route('payment_gateway.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/payment_gateway/*', 'organizations/payment_gateway/*') ? 'active' : '' }}">
                                    {{ __('Payment Gateway') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                </li>
                {{-- general setting end --}}

                @can('invoice.index')
                    <li>
                        <a class="menu {{ request()->is('admin/invoice*') ? 'active' : '' }}" data-bs-toggle="collapse"
                            href="#invoiceManagement">
                            <span>
                                <img style="text-primary" class="menu-icon"
                                    src="{{ asset('assets/images/menu/invoice.svg') }}" alt="icon"
                                    loading="lazy" />
                                {{ __('Invoice Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/invoice*') ? 'show' : '' }}"
                            id="invoiceManagement">
                            <div class="listBar">
                                @can('invoice.index')
                                    <a href="{{ route('invoice.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/invoice/list*') ? 'active' : '' }}">
                                        {{ __('Invoices') }}
                                    </a>
                                @endcan
                                @can('invoice.create')
                                    <a href="{{ route('invoice.create') }}"
                                        class="subMenu hasCount {{ request()->is('admin/invoice/create*') ? 'active' : '' }}">
                                        {{ __('Generate New Invoice') }}
                                    </a>
                                @endcan
                                @can('invoice.update')
                                    <a href="{{ route('invoice.trash') }}"
                                        class="subMenu hasCount {{ request()->is('admin/invoice/list/restore*') ? 'active' : '' }}">
                                        {{ __('Restore Invoices') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcan

                {{-- general setting end --}}

                {{-- legal page start --}}
                @canany(['page.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Page Management') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin/page/*', 'organizations/page/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersLegal">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/file-text-shield.svg') }}"
                                    alt="icon" loading="lazy" />
                                {{ __('Legal Pages') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon"
                                class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/page/*', 'organizations/page/*') ? 'show' : '' }}"
                            id="ordersLegal">
                            <div class="listBar">
                                <a href="{{ route('page.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('page.index') ? 'active' : '' }}">
                                    {{ __('All Pages') }}
                                </a>
                                <a href="{{ route('page.edit', 'about_us') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/about_us', 'organizations/page/edit/about_us') ? 'active' : '' }}">
                                    {{ __('About Us') }}
                                </a>
                                <a href="{{ route('page.edit', 'contact_us') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/contact_us', 'organizations/page/edit/contact_us') ? 'active' : '' }}">
                                    {{ __('Contact Us') }}
                                </a>
                                <a href="{{ route('page.edit', 'faq') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/faq', 'organizations/page/edit/faq') ? 'active' : '' }}">
                                    {{ __('FAQ') }}
                                </a>
                                <a href="{{ route('page.edit', 'privacy_policy') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/privacy_policy', 'organizations/page/edit/privacy_policy') ? 'active' : '' }}">
                                    {{ __('Privacy Policy') }}
                                </a>
                                <a href="{{ route('page.edit', 'terms_and_conditions') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/terms_and_conditions', 'organizations/page/edit/terms_and_conditions') ? 'active' : '' }}">
                                    {{ __('Terms & Conditions') }}
                                </a>
                                <a href="{{ route('page.edit', 'refund_policy') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/refund_policy', 'organizations/page/edit/refund_policy') ? 'active' : '' }}">
                                    {{ __('Refund Policy') }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endcanany

                {{-- legal page end --}}


                {{-- logout start --}}
                <li class="menu-divider">
                    <span class="menu-title">{{ __('Sign Out') }}</span>
                </li>
                <li>
                    <a class="menu" href="{{ route('admin.logout') }}">
                        <span class="text-danger">
                            <img class="menu-icon" src="{{ asset('assets/images/menu/log-out.svg') }}"
                                alt="icon" loading="lazy" />
                            {{ __('Logout Account') }}
                        </span>
                    </a>
                </li>
                {{-- logout end --}}


                @if (Auth::user()->hasRole('admin'))
                    <div class="sideBarfooter">
                        <a href="{{ route('setting.index') }}" class="fullbtn"><i class="fa-solid fa-gear"></i></a>
                        <button type="button" class="fullbtn hite-icon" onclick="toggleFullScreen(document.body)"><i
                                class="fa-solid fa-expand"></i></button>

                        <a href="{{ route('cache.clear') }}" class="fullbtn hite-icon" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="{{ __('Website Cache Clear') }}"><i class="bi bi-radioactive"></i></a>

                        <a href="{{ route('admin.logout') }}" class="fullbtn hite-icon"><i
                                class="fa-solid fa-power-off"></i></a>
                    </div>
                @endif

        </div>
    </div>
</div>
<!-- End-Sidebar-Menu-Section -->
