<!DOCTYPE html>
<html lang="en">

<!-- Head element -->
<head>
    @include('partials._head')
</head>

<!-- Body element -->
<body>

    <!-- Navigation -->
    @include('partials._nav')

    <!-- Main container -->
    <div class="container content">

        <!-- Show success and error messages -->
        @include('partials._messages')

        <!-- Main content -->
        @yield('content')

        <!-- Footer -->
        @include('partials._footer')

    </div>

    <!-- Javascript libraries -->
    @include('partials._javascript')

</body>

</html>