
<!-- Success and error messages on form validation -->

<!-- success message -->
@if (Session::has('success'))

    <div class="alert alert-success" role="alert">
        <strong>Success: </strong> {{ Session::get('success') }}
    </div>

@endif

<!-- Warning message -->
@if (Session::has('warning'))

    <div class="alert alert-danger" role="alert">
        <strong>Warning: </strong> {{ Session::get('warning') }}
    </div>

@endif

<!-- Error message -->
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">

        <strong>Errors:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif