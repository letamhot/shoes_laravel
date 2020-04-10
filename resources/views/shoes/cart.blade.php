@extends('shoes.partials.layout')

@section('title', 'Cart')

@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('shoesHome') }}">Home</a></li>
                <li class="active">Shopping Cart at {{ auth::user()->name }}</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="id">#</td>
                        <td class="image">Item</td>
                        <td class="product">Product</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    @foreach (Cart::content() as $key => $item)

                    <tr>
                        <td class="id">{{ $i }}</td>
                        <td class="cart_image">
                            <a href="{{ route('productdetail', $item->id) }}"><img
                                    src="data:image;base64, {{ $item->options->img }}" alt="{{ $item->name }}"
                                    width="100px"></a>
                        </td>
                        <td class=" cart_product">
                            <h4><a href="{{ route('productdetail', $item->id) }}">{{ $item->name }}</a></h4>
                            {{-- <p>{{ $product->type->name  }}</p> --}}
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($item->price) }} vnd</p>
                        </td>
                        <td class="cart_quantity">

                            <div class="quantity">
                                <div class="form-group">
                                    <input type="number" name="qty" class="form-control qty" value="{{ $item->qty }}"
                                        min='1' data-id="{{ $item->rowId }}">
                                </div>
                            </div>

                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ number_format($item->total) }}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ route('deleteCart', $item->rowId) }}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>{{ (Cart::total()) }} VND</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>{{ (Cart::total()) }} VND</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->

@endsection

@push('update_cart')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(document).ready(function() {
        $('.qty').blur(function() {
            let rowid = $(this).data('id');
            $.ajax({
                url: 'cartt/' + rowid,
                type: 'put',
                dataType: 'json',
                data: {
                    qty: $(this).val(),
                },
                success: function(data) {
                    if (data.error) {
                        toastr.error(data.error, 'Error!!!', {
                            timeOut: 5000
                        });
                    } else {
                        toastr.success(data.result, 'Success', {
                            timeOut: 5000
                        });
                        location.reload();

                    }
                }
            });
        });
    });
</script>
@endpush
