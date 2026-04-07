<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.partials.styles')
</head>
<body>
    <div class="page-layout">
        <!-- begin::GXON Page Header -->
        @include('dashboard.partials.header')
        <!-- end::GXON Page Header -->

        <!-- Search Modal -->
        @include('dashboard.partials.search-modal')

        <!-- begin::GXON Sidebar Menu -->
        @include('dashboard.partials.sidebar')
        <!-- end::GXON Sidebar Menu -->

        <!-- begin::GXON Sidebar right -->
        @include('dashboard.partials.sidebar-right')
        <!-- end::GXON Sidebar right -->

        <main class="app-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <!-- begin::GXON Footer -->
        @include('dashboard.partials.footer')
        <!-- end::GXON Footer -->
    </div>

    @include('dashboard.partials.scripts')
</body>
</html>
