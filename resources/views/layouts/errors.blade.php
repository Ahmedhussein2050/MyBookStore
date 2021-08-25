@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="m-2 w-50 m-auto">
            <p class="alert alert-danger">{{ $error }}</p>
        </div>
    @endforeach
@endif
