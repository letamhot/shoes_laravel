@extends('admin.layouts')

@section('title', 'Garbage can bills')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">
        <a href="{{ route('bills.index') }}" class="btn btn-primary">Home page bills</a>

        <a href="{{ route('bills.delete-all') }}" class="btn btn-danger float-right"
            onclick="return confirm('Do you want destroy all? All data can\'t be restore!')">Delete all</a>

        <a href="{{ route('bills.restore-all') }}" class="btn btn-warning float-right mr-2"
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
                    style="font-size: 14px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id bill</th>
                            <th>Customer</th>
                            <th>Detail Customer</th>
                            <th width='10%'>Date order</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th width='7%'>Pay money</th>
                            <th>Status</th>
                            <th>Bill detail</th>
                            <th>User deleted</th>
                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Destroy</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Id bill</th>
                            <th>Customer</th>
                            <th>Detail Customer</th>
                            <th width='10%'>Date order</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th width='7%'>Pay money</th>
                            <th>Status</th>
                            <th>Bill detail</th>
                            <th>User deleted</th>
                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Destroy</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($bills as $key => $bills)

                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $bills->id }}</td>
                            <td>{{ $bills->customer->id }} - {{ $bills->customer->name }}</td>
                            <td><button data-url="{{ route('bills.show',$bills->id) }}" ​ type="button"
                                    data-target="#showbills" data-toggle="modal"
                                    class="btn btn-info btn-show btn-sm">Detail</button></td>
                            <td>{{ $bills->date_order }}</td>
                            <td>{{ $bills->total }} VND</td>
                            <td>{{ $bills->payment }}</td>
                            {{-- <td><a href="{{ route('bills.show', $bills->id) }}">Details</a></td> --}}

                            @if($bills->pay_money == 1)
                            <td><a href="{{ route('bills.pay_money', $bills->id) }}" class="ajax_link"
                                    style="color:#32CD32; font-weight: bold"
                                    onclick="return confirm('Do you want change pay money column of this bills to not paid?')">Paid</a>
                            </td>
                            @else
                            <td><a href="{{ route('bills.pay_money', $bills->id) }}" class="ajax_link"
                                    style="color:red; font-weight: bold"
                                    onclick="return confirm('Do you want change pay money column of this bills to paid?')">Not
                                    paid</a>
                            </td>
                            @endif
                            @if($bills->status == 1)
                            <td><a href="{{ route('bills.status', $bills->id) }}"
                                    style="color:#32CD32; font-weight: bold"
                                    onclick="return confirm('Do you want change status column of this bills to Uncomplete?')">Complete</a>
                            </td>
                            @else
                            <td><a href="{{ route('bills.status', $bills->id) }}" style="color:red; font-weight: bold;"
                                    onclick="return confirm('Do you want change status column of this bills to complete?')">Uncomplete</a>
                            </td>
                            @endif

                            <td align="center"><a href="{{ route('bills.details', $bills->id) }}"
                                    style="color:blue; font-weight: bold; font-size:20px;">{{ count($bills->bill_detail) }}</a>
                            </td>

                            <td><b style="color:orange">{{ $bills->user_deleted }}</b> <br> {{ $bills->deleted_at }}
                            </td>
                            <td><a href="{{ route('bills.edit', $bills->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>
                            </td>
                            <td><a href="{{ route('bills.restore', $bills->id) }}" class="btn btn-warning btn-sm"
                                    onclick="return confirm('Do you want restore bills {{ $bills->name }}?')">
                                    <i class="far fa-window-restore" aria-hidden="true" title="Restore"></i></a>
                            </td>

                            <td>
                                <a href="{{ route('bills.delete', $bills->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Do you want destroy bills {{ $bills->name }}?')">
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
@include('admin.bills.detail')
@endsection

@push('show-ajax')
{{-- @csrf ajax--}}
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
                    $('h4#name').html(response.data.name)
                    $('h1#descriptor').html("Id customer: " + response.data.id)
                    $('span#username').html("Username: " + response.data.username)
                    $('span#name').html("Name: " + response.data.name)
                    $('span#email').html("Email: " + response.data.email)
                    $('span#address').html("Address: " + response.data.address)
                    $('span#postcode').html("Post code: " + response.data.postcode)
                    $('span#city').html("City: " + response.data.city)
                    $('span#country').html("Country: " + response.data.country)
                    $('span#phone').html("Phone: +84 " + response.data.phone)

                    $('span#last_updated').html("Last updated: " + response.data.updated_at.substring(0,19))
                    $('span#user_updated').html("User updated: " + response.data.user_updated)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })
    });
</script>
@endpush
