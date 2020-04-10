@extends('admin.layouts')

@section('title', 'Garbage can producer')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">
        <a href="{{ route('producer.index') }}" class="btn btn-primary">Home page producers</a>

        <a href="{{ route('producer.delete-all') }}" class="btn btn-danger float-right"
            onclick="return confirm('Do you want destroy all? All data can\'t be restore!')">Delete all</a>

        <a href="{{ route('producer.restore-all') }}" class="btn btn-warning float-right mr-2"
            onclick="return confirm('Do you want restore all data?')">Restore all</a>
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Garbage can</h6>
        </div>

        <div class="col-sm-12">@include('partials.message')</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                    style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Tax_code</th>
                            <th>Image</th>
                            <th>Deleted_at</th>

                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Destroy</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Tax_code</th>
                            <th>Image</th>
                            <th>Deleted_at</th>
                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Destroy</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach($producer as $key => $value)

                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->address}}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->tax_code}}</td>
                            <td><img src="data:image;base64, {{ $value->image }}" width="60px" height="60px"></td>
                            <td>{{$value->deleted_at}}</td>

                            <td>
                                {{-- <a href="{{ route('producer.show', $value->id) }}" class="btn btn-primary">Show</a>
                                --}}
                                <a href="{{ route('producer.edit', $value->id) }}" class="btn btn-primary"><i
                                        class="fa fa-edit" title="Edit"></i></a>
                            </td>

                            <td><a href="{{ route('producer.restore', $value->id) }}" class="btn btn-warning"
                                    onclick="return confirm('Do you want restore producer {{ $value->name }}?')">
                                    <i class="far fa-window-restore" aria-hidden="true" title="Restore"></i></a>
                            </td>

                            <td>
                                <a href="{{ route('producer.delete', $value->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Do you want destroy type {{ $value->name }}?')">
                                    <i class="fa fa-minus-circle" title="Destroy"></i>
                                </a>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

{{-- @push('show-ajax')
<meta name="csrf-token" content="{{ csrf_token() }}">​
<script type="text/javascript" charset="utf-8">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>
<script>
    $(document).ready(function () {
        $('.btn-show').click(function(){
            var url = $(this).attr('data-url');
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    // console.log(response)
                    $('h4#name').html(response.data.title)
                    $('h1#descriptor').html(response.data.description)
                    $('span#created_at').html("Created_at: " + response.data.created_at.substring(0,19))
                    $('span#updated_at').html("Updated_at: " + response.data.updated_at.substring(0,19))
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            })
        })
    });
</script>
@endpush --}}
