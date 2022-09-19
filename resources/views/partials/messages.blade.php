@if ($errors->any())

    <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
        <div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg> --}}
        <div class="alert alert-succes">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible d-flex my-2 align-items-center" role="alert" >
        <div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg> --}}
        <div class="alert alert-succes">
            {{ session()->get('success') }}
        </div>
    </div>
@endif
