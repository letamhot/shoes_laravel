{{-- Success messeage --}}

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- Delete messeage --}}
@if(session('delete'))
<div class="alert alert-danger">
    {{ session('delete') }}
</div>
@endif

{{-- Validate Error --}}

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



@if (session('error'))

<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif
