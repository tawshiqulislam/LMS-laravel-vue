@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('DNS Management'))

@section('content')
    <div class="app-main-outer">
        <div class="app-main-inner">

            <div
                class="page-title-actions px-3 py-3 d-flex justify-content-between align-items-center bg-white rounded mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('DNS') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 mx-auto">

                        <!-- ===== Domain Input (Modern) ===== -->
                        <div class="card border-0 shadow-xl rounded-4 mb-5 overflow-hidden">
                            <div class="p-3 p-md-4 text-white"
                                style="background: radial-gradient(1200px 600px at 10% 10%, #4e73df 0%, #36b9cc 45%, #1cc88a 100%);">
                                <h3 class="mb-1 d-flex align-items-center">
                                    <i class="bi bi-globe2 me-2"></i> {{ __('Add Your Domain') }}
                                </h3>
                                <p class="opacity-75 mb-0">
                                    {{ __('Connect your custom domain to the main hosting in a few steps.') }}</p>
                            </div>

                            <div class="card-body p-4 p-md-5">
                                <form action="{{ route('org.dns.store') }}" method="POST" class="needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="mb-4">
                                        <label for="domainInput" class="form-label fw-semibold">
                                            <i class="bi bi-link-45deg me-1 text-primary"></i>{{ __('Domain Name') }} <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-lg bg-dark text-white px-3"><i
                                                    class="bi bi-shield-check"></i></span>
                                            <input type="text" class="form-control rounded-end-lg" id="domainInput"
                                                name="domain" placeholder="example.com"
                                                value="{{ old('domain') ?? ($domain ?? '') }}" required>
                                        </div>
                                        @error('domain')
                                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                        @enderror
                                        <small
                                            class="text-muted d-block mt-1">{{ __('Enter only your root domain, e.g., mywebsite.com') }}</small>
                                        <div class="invalid-feedback">{{ __('Please enter a valid domain.') }}</div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-lg btn-primary rounded-pill px-5 shadow-sm">
                                            <i class="bi bi-check-circle me-2"></i>{{ __('Save Domain') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- ===== Admin Quick Facts (Copy-friendly) ===== -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-0 py-4">
                                <h5 class="mb-0 d-flex align-items-center">
                                    <i class="bi bi-hdd-network me-2 text-primary"></i>{{ __('Admin Quick Facts') }}
                                </h5>
                                <p class="text-muted mb-0">
                                    {{ __('Use these values while configuring registrar, DNS, hosting root and SSL.') }}
                                </p>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row g-3">

                                    <div class="col-md-6 col-lg-4">
                                        <div
                                            class="p-3 rounded-4 border d-flex justify-content-between align-items-start hover-lift">
                                            <div>
                                                <div class="text-muted small">{{ __('Server Name') }}</div>
                                                <div class="fw-semibold" id="val-server-name">
                                                    {{ $server->server_name ?? 'Main Hosting' }}</div>
                                            </div>
                                            <button class="btn btn-light btn-sm rounded-pill copy-btn"
                                                data-copy="#val-server-name" data-bs-toggle="tooltip" title="Copy">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div
                                            class="p-3 rounded-4 border d-flex justify-content-between align-items-start hover-lift">
                                            <div>
                                                <div class="text-muted small">{{ __('Primary Domain') }}</div>
                                                <div class="fw-semibold" id="val-domain">
                                                    {{ $server->domain ?? 'example.com' }}
                                                </div>
                                            </div>
                                            <button class="btn btn-light btn-sm rounded-pill copy-btn"
                                                data-copy="#val-domain" data-bs-toggle="tooltip" title="Copy">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div
                                            class="p-3 rounded-4 border d-flex justify-content-between align-items-start hover-lift">
                                            <div>
                                                <div class="text-muted small">{{ __('Name Server 1') }}</div>
                                                <div class="fw-semibold" id="val-ns1">
                                                    {{ $server->ns1 ?? 'ns1.yourhost.com' }}</div>
                                            </div>
                                            <button class="btn btn-light btn-sm rounded-pill copy-btn" data-copy="#val-ns1"
                                                data-bs-toggle="tooltip" title="Copy">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div
                                            class="p-3 rounded-4 border d-flex justify-content-between align-items-start hover-lift">
                                            <div>
                                                <div class="text-muted small">{{ __('Name Server 2') }}</div>
                                                <div class="fw-semibold" id="val-ns2">
                                                    {{ $server->ns2 ?? 'ns2.yourhost.com' }}</div>
                                            </div>
                                            <button class="btn btn-light btn-sm rounded-pill copy-btn" data-copy="#val-ns2"
                                                data-bs-toggle="tooltip" title="Copy">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div
                                            class="p-3 rounded-4 border d-flex justify-content-between align-items-start hover-lift">
                                            <div>
                                                <div class="text-muted small">{{ __('Root Path') }}</div>
                                                <div class="fw-semibold" id="val-root">
                                                    {{ $server->root_path ?? '/home/username/public_html' }}</div>
                                            </div>
                                            <button class="btn btn-light btn-sm rounded-pill copy-btn" data-copy="#val-root"
                                                data-bs-toggle="tooltip" title="Copy">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div
                                            class="p-3 rounded-4 border d-flex justify-content-between align-items-center hover-lift">
                                            <div>
                                                <div class="text-muted small">{{ __('SSL Enabled') }}</div>
                                                @php $ssl = isset($server->ssl_enabled) ? filter_var($server->ssl_enabled, FILTER_VALIDATE_BOOLEAN) : false; @endphp
                                                <span
                                                    class="badge {{ $ssl ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                                    <i class="bi {{ $ssl ? 'bi-lock-fill' : 'bi-unlock' }} me-1"></i>
                                                    {{ $ssl ? __('True') : __('False') }}
                                                </span>
                                            </div>
                                            <i
                                                class="bi bi-shield-lock text-{{ $ssl ? 'success' : 'secondary' }} fs-5"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- ===== Server Admin Playbook (Step-by-step) ===== -->
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-white border-0 py-4">
                                <h5 class="mb-1 d-flex align-items-center">
                                    <i class="bi bi-list-check me-2 text-success"></i>{{ __('Server Admin Playbook') }}
                                </h5>
                                <p class="text-muted mb-0">
                                    {{ __('Follow these steps to connect the domain to main hosting cleanly and safely.') }}
                                </p>
                            </div>

                            <div class="card-body p-4">
                                <ol class="timeline-for-dns list-unstyled mb-0">

                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-primary-subtle"><i class="bi bi-clipboard-check"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold mb-1">{{ __('Step 1 — Confirm Server Profile') }}</h6>
                                            <p class="text-muted mb-2">
                                                {{ __('Make sure you have these values ready:') }}
                                                <code class="px-2 py-1 rounded bg-light border">server_name</code>,
                                                <code class="px-2 py-1 rounded bg-light border">domain</code>,
                                                <code class="px-2 py-1 rounded bg-light border">ns1</code>,
                                                <code class="px-2 py-1 rounded bg-light border">ns2</code>,
                                                <code class="px-2 py-1 rounded bg-light border">root_path</code>,
                                                <code class="px-2 py-1 rounded bg-light border">ssl_enabled</code>.
                                            </p>
                                            <div class="small text-muted">
                                                {{ __('Tip: Copy from the “Admin Quick Facts” above.') }}</div>
                                        </div>
                                    </li>

                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-info-subtle"><i class="bi bi-diagram-3"></i></div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold mb-1">{{ __('Step 2 — Update Registrar Nameservers') }}
                                            </h6>
                                            <p class="mb-2">
                                                {{ __('At the domain registrar, set Nameserver 1 & 2 to:') }}
                                                <span class="d-inline-flex align-items-center ms-2">
                                                    <code id="t-ns1"
                                                        class="px-2 py-1 rounded bg-light border me-2">{{ $server->ns1 ?? 'ns1.yourhost.com' }}</code>
                                                    <button class="btn btn-sm btn-outline-secondary rounded-pill copy-btn"
                                                        data-copy="#t-ns1"><i class="bi bi-clipboard"></i></button>
                                                </span>
                                                <span class="d-inline-flex align-items-center ms-2">
                                                    <code id="t-ns2"
                                                        class="px-2 py-1 rounded bg-light border me-2">{{ $server->ns2 ?? 'ns2.yourhost.com' }}</code>
                                                    <button class="btn btn-sm btn-outline-secondary rounded-pill copy-btn"
                                                        data-copy="#t-ns2"><i class="bi bi-clipboard"></i></button>
                                                </span>
                                            </p>
                                            <div class="small text-muted">
                                                {{ __('Propagation usually completes within 5 minutes to 24 hours.') }}
                                            </div>
                                        </div>
                                    </li>

                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-warning-subtle"><i class="bi bi-folder2-open"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold mb-1">{{ __('Step 3 — Add Domain in Hosting & Set Root') }}
                                            </h6>
                                            <p class="mb-2">
                                                {{ __('In your hosting panel (cPanel, Plesk, etc.): add the domain and set Document Root to:') }}
                                                <span class="d-inline-flex align-items-center ms-2">
                                                    <code id="t-root"
                                                        class="px-2 py-1 rounded bg-light border me-2">{{ $server->root_path ?? '/home/username/public_html' }}</code>
                                                    <button class="btn btn-sm btn-outline-secondary rounded-pill copy-btn"
                                                        data-copy="#t-root"><i class="bi bi-clipboard"></i></button>
                                                </span>
                                            </p>
                                            <div class="small text-muted">
                                                {{ __('Ensure the web files (public/index.php etc.) are reachable under this path.') }}
                                            </div>
                                        </div>
                                    </li>

                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-secondary-subtle"><i class="bi bi-gear"></i></div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold mb-1">{{ __('Step 4 — DNS Zone Check') }}</h6>
                                            <p class="mb-2">
                                                {{ __('If you changed nameservers to your hosting, the DNS zone is now managed there. Verify that the root A record and www CNAME/A exist and point to the server. If not, create them as needed.') }}
                                            </p>
                                            <div class="small text-muted">
                                                {{ __('Optional: Add AAAA record if your server has IPv6.') }}</div>
                                        </div>
                                    </li>

                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-success-subtle"><i class="bi bi-shield-lock"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold mb-1">{{ __('Step 5 — Issue SSL (HTTPS)') }}</h6>
                                            @if ($ssl)
                                                <p class="mb-2">
                                                    {{ __('SSL is enabled in admin. Run AutoSSL / Let’s Encrypt from hosting to issue a certificate for') }}
                                                    <code
                                                        class="px-2 py-1 rounded bg-light border">{{ $server->domain ?? 'example.com' }}</code>
                                                    {{ __('and') }} <code
                                                        class="px-2 py-1 rounded bg-light border">www</code>.
                                                </p>
                                            @else
                                                <div class="alert alert-secondary py-2 px-3 rounded-3 mb-2">
                                                    <i
                                                        class="bi bi-exclamation-triangle me-2"></i>{{ __('SSL is currently disabled in admin. Enable it and then issue the certificate from hosting.') }}
                                                </div>
                                            @endif
                                            <div class="small text-muted">
                                                {{ __('Force HTTPS in your app/web server once the cert is active.') }}
                                            </div>
                                        </div>
                                    </li>

                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-primary-subtle"><i class="bi bi-check2-circle"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold mb-1">{{ __('Step 6 — Verify & Go Live') }}</h6>
                                            <ul class="text-muted mb-0 ms-3">
                                                <li>{{ __('Check NS & A/CNAME records on whatsmydns.net') }}</li>
                                                <li>{{ __('Open http:// and https:// to confirm redirect & SSL padlock') }}
                                                </li>
                                                <li>{{ __('Clear app cache, CDN, and browser cache if needed') }}</li>
                                            </ul>
                                        </div>
                                    </li>

                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection


@push('styles')
    <style>
        .hover-lift {
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08) !important;
        }

        .timeline-for-dns {
            position: relative;
            padding-left: 0;
        }

        .timeline-item {
            position: relative;
            padding-left: 4rem;
            margin-bottom: 1.75rem;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }
        .timeline-item:last-child::before {
           bottom: 0;
        }

        .timeline-item:before {
            content: "";
            position: absolute;
            left: 1.3rem;
            top: 10px;
            bottom: -30px;
            width: 2px;
            background: rgba(0, 0, 0, .06);
        }

        .timeline-icon {
            position: absolute;
            left: 0;
            width: 2.6rem;
            height: 2.6rem;
            border-radius: 50%;
            display: grid;
            place-items: center;
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .06);
        }

        .timeline-content h6 {
            margin-top: .25rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            // Tooltips
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(el) {
                new bootstrap.Tooltip(el);
            });

            // Copy buttons
            function copyText(selector) {
                const el = document.querySelector(selector);
                if (!el) return;
                const text = el.innerText.trim();
                navigator.clipboard.writeText(text).then(() => {
                    // Optional: small toast/tooltip flicker
                });
            }
            document.querySelectorAll('.copy-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const target = this.getAttribute('data-copy');
                    copyText(target);
                    this.innerHTML = '<i class="bi bi-clipboard-check"></i>';
                    setTimeout(() => this.innerHTML = '<i class="bi bi-clipboard"></i>', 1200);
                });
            });

            // Client-side validation styling
            const form = document.querySelector('form.needs-validation');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }
        })();
    </script>
@endpush
