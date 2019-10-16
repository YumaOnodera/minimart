<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger mb-0">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (session('flash_message'))
            <div class="alert alert-success mb-0">
                <ul class="mb-0">
                    <li>{{ session('flash_message') }}</li>
                </ul>
            </div>
        @elseif (session('error_message'))
            <div class="alert alert-danger mb-0">
                <ul class="mb-0">
                    <li>{{ session('error_message') }}</li>
                </ul>
            </div>
        @endif
    </div>
</div>