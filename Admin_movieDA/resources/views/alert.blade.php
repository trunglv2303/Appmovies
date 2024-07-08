@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('error'))
<div class="alert alert-error" style="background-color: red; font-size: 16px; color: white">
    {{ session('error') }}
</div>
@endif


@php
$successMessage = session('success');
$successTimeout = session('success_timeout');
@endphp

@if($successMessage && $successTimeout && \Carbon\Carbon::now()->diffInSeconds($successTimeout, false) > 0)
<div class="alert alert-success">
    {{ $successMessage }}
</div>
@endif