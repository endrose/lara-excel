@if (session('success'))
<div class="container mt-3">
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
</div>
@endif

@if (session('info'))
<div class="container">
    <div class="alert alert-info text-center">
        {{ session('info') }}
    </div>
</div>
@endif

@if (session('danger'))
<div class="container">
    <div class="alert alert-danger text-center">
        {{ session('danger') }}
    </div>
</div>
@endif

