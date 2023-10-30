@if ($errors->any())
    <div class="container" style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            <br>
        @endforeach
    </div>
@endif




@if (session('success'))
    <div class="container" style="color: green;">

        @php
            $suc_array = explode('@@', session('success'));
            $i = 1;
        @endphp

        @foreach ($suc_array as $suc)
            <p>{{ $i }}.{{ $suc }} &nbsp;&nbsp;</p>
            @php
                $i++;
            @endphp
        @endforeach
    </div>
@endif
