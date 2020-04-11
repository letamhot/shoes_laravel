@extends('admin.layouts')

@section('title', 'Bills')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Home</a>
        <a href="{{ route('bills.trash') }}" class="btn btn-danger" style="float:right">Garbage can</a>
    </p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of bills</h6>
        </div>

        <div class="col-sm-12">@include('partials.message')</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                    style="font-size: 13.5px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id bill</th>
                            <th>Customer</th>
                            <th>Detail Customer</th>
                            <th width='8.5%'>Date order</th>
                            <th>Total</th>
                            <th width='8.5%'>Payment</th>
                            <th>Pay money</th>
                            <th width='8%'>Status</th>
                            <th width='7%'>Bill detail</th>
                            <th width='10%'>User updated</th>
                            <th width='4%'>Edit</th>
                            <th width='5%'>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Id bill</th>
                            <th>Customer</th>
                            <th>Detail Customer</th>
                            <th width='8.5%'>Date order</th>
                            <th>Total</th>
                            <th width='8.5%'>Payment</th>
                            <th>Pay money</th>
                            <th width='8%'>Status</th>
                            <th width='7%'>Bill detail</th>
                            <th width='10%'>User updated</th>
                            <th width='4%'>Edit</th>
                            <th width='5%'>Delete</th>
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
                            <td>${{ $bills->total }}</td>
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

                            <td><a href="{{ route('bills.details', $bills->id) }}"
                                    style="color:blue; font-weight: bold; font-size:20px;">{{ count($bills->bill_detail) }}</a>
                            </td>

                            <td><b style="color:purple">{{ $bills->user_updated }}</b> <br> {{ $bills->updated_at }}
                            </td>
                            <td><a href="{{ route('bills.edit', $bills->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit" title="Edit"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('bills.destroy', $bills->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Do you want delete bills {{$bills->name}} ?')"
                                        class="btn btn-danger btn-sm"><i class="fa fa-backspace"></i></button>
                                </form>
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
