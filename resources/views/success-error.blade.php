@if ($errors->any())
<div class="container" style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            <br>
        @endforeach
</div>
@endif

@if(session('success'))
<div style="color: green;">
{{ session('success') }}
</div>
@endif
