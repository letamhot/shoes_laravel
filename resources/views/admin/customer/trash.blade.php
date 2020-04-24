@extends('admin.layouts')

@section('title', 'Garbage can customer')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">
        <a href="{{ route('customer.index') }}" class="btn btn-primary">Home page customer</a>

        {{-- <a href="{{ route('customer.delete-all') }}" class="btn btn-danger float-right"
        onclick="return confirm('Do you want destroy all? All data can\'t be restore!')">Delete all</a>

        <a href="{{ route('customer.restore-all') }}" class="btn btn-warning float-right mr-2"
            onclick="return confirm('Do you want restore all data?')">Restore all</a> --}}
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
                    style="font-size: 14px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Order number</th>
                            <th>Email</th>
                            <th width='15%'>Address</th>
                            <th>Postcode</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Active</th>
                            <th width='15%'>User deleted</th>
                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Order number</th>
                            <th>Email</th>
                            <th width='15%'>Address</th>
                            <th>Postcode</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Active</th>
                            <th width='15%'>User deleted</th>
                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($customer as $key => $customer)

                        <tr>

                            <td>{{ ++$key }}</td>
                            <td>{{ $customer->name }}</td>

                            <td>{{ count($customer->bills_trash) }}</td>

                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->postcode }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ $customer->country }}</td>
                            <td>+84 {{ $customer->phone }}</td>

                            @if($customer->active == 1)
                            <td><a href="{{ route('customer.active', $customer->id) }}"
                                    style="color:#32CD32; font-weight: bold;"
                                    onclick="return confirm('Do you want change active column of this customer?')">Yes</a>
                            </td>
                            @else
                            <td><a href="{{ route('customer.active', $customer->id) }}"
                                    style="color:red; font-weight: bold;"
                                    onclick="return confirm('Do you want change active column of this customer?')">No</a>
                            </td>
                            @endif

                            <td><b style="color:purple">{{ $customer->user_updated }}</b> <br>
                                {{ $customer->updated_at }}
                            </td>

                            <td><a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>
                            </td>

                            <td><a href="{{ route('customer.restore', $customer->id) }}" class="btn btn-warning btn-sm"
                                    onclick="return confirm('Do you want restore customer {{ $customer->name }}?')">
                                    <i class="far fa-window-restore" aria-hidden="true" title="Restore"></i></a>
                            </td>

                            <td>
                                <a href="{{ route('customer.delete', $customer->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Do you want destroy customer {{ $customer->name }}?')">
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
