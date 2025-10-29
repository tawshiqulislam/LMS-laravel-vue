@php
    $selectedLang = app()->getLocale();
    $languageLabels = [
        'en' => __('English'),
        'fr' => __('français'),
        'bn' => __('বাংলা'),
        'ar' => __('العربية'),
    ];
@endphp

<div class="container-fluids">
    <div id="tp-header-sticky" class="tp-ride-header-area p-relative z-1" style="padding: 26px 40px 26px 26px;"
        data-bg-color="#fff">
        <div class="row align-items-center ">
            <div class="col-xl-2 col-lg-1 col-md-1 col-4">
                <div class="tp-header-left">
                    <div class="tp-header-menu-icon">
                        <a id="sidebar__active" href="javascript:void(0)">
                            <img src="{{ asset('org_assets') }}/img/icon/menu-icon.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-10 col-lg-11 col-md-11 col-8">
                <div class="tp-header-right d-flex align-items-center justify-content-end">

                    <div class="badgeButtonBox px-3">
                        <div class="notifactionIcon position-relative">
                            <button type="button" class="emailBadge shadow-lg dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/images/menu/bell-on.svg') }}" alt="notification">
                                <span class="position-absolute notificationCount"
                                    id="totalNotify">{{ $notificationMessages->where('is_read', 0)->count() }}</span>
                            </button>
                            <div class="dropdown-menu p-0 emailNotifactionSection">
                                <div class="dropdown-item emailNotifaction">
                                    <div class="emailHeader">
                                        <h6 class="massTitel">
                                            {{ __('Notifications') }}
                                        </h6>
                                        <a href="{{ route('notification.read.all') }}" class="text-dark"
                                            style="cursor: pointer">
                                            {{ __('Marks all as read') }}
                                        </a>
                                    </div>
                                    <div class="messege-section" id="notifications">
                                        @foreach ($notificationMessages as $notification)
                                            @php
                                                $metadata = json_decode($notification->metadata, true);
                                            @endphp
                                            <a href="{{ $notification->is_read ? 'javascript:void(0)' : route('notification.read', $notification->id) }}"
                                                class="item d-flex gap-2 align-items-center">
                                                <div class="iconBox {{ $notification->is_read ? '' : 'pdfIcon' }}">
                                                    <i class="bi bi-chat-left-text-fill"></i>
                                                </div>
                                                <div
                                                    class="notification w-100 {{ $notification->is_read ? '' : 'unread' }}">
                                                    <div class="userName">
                                                        <p class="massTitel m-0">
                                                            {{ $notification->notification->heading }}
                                                        </p>
                                                        <span
                                                            class="time m-0">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div>
                                                        <p class="description m-0">{{ $notification->content }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="emailFooter">
                                        <a class="massPera text-dark">
                                            {{ __('View All Notifications') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tp-header-lang mr-16 p-relative d-none d-md-block">
                        <a href="#">
                            <img src="{{ asset('org_assets') }}/img/icon/lang-icon.png" alt="">
                            <span class="tp-header-icon-title">
                                {{ ucfirst($selectedLang ?? __('eng')) }}
                                <i class="fal fa-angle-down"></i>
                            </span>
                        </a>
                        <div class="tp-header-more-lang p-absolute">
                            @foreach ($languages as $language)
                                <a href="{{ route('change.language', 'language=' . $language->name) }}"
                                    class="{{ $language->name == app()->getLocale() ? 'active' : '' }}">
                                    <i class="fa fa-language mr-3"></i>
                                    {{ $languageLabels[$language->title] ?? $language->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="tp-header-author d-flex align-items-center p-relative">
                        <div class="tp-header-author-content mr-12 text-end">
                            <a href="#" class="tp-header-author-name">
                                {{ auth()->user()?->name ?? 'User Name' }} <br>
                            </a>
                            <span>
                                {{ auth()->user() ? auth()->user()->getRoleNames()->first() : 'guest' }}
                            </span>
                        </div>
                        <div class="tp-header-author-thumb">
                            <a href="javascript:void(0)">
                                <img src="{{ auth()->user()?->profilePicturePath ?? asset('assets/images/avatars/MD.png') }}"
                                    alt="">
                            </a>
                        </div>
                        <div class="tp-header-author-thumb-more p-absolute">
                            <a href="{{ route('org.profile', auth()->user()?->id) }}"><i
                                    class="fal fa-user-alt"></i>{{ __('Profile') }}</a>
                            <a href="/">
                                <i class="fal fa-chess-king"></i>{{ __('Visit Website') }}
                            </a>
                            <a href="{{ route('admin.logout') }}" class="text-danger">
                                <i class="fal fa-sign-out"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
