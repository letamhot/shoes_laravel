<section id="cart_items">
    <div class="container">

        @include('partials.message')

        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('shoesHome') }}">Home</a></li>
                <li class="active">Shopping Cart at {{ auth::user()->name }}</li>
            </ol>
        </div>
        <form action="{{ route('cartt.store') }}" method='POST'>
            @csrf
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="id">#</td>
                            <td class="image">Item</td>
                            <td class="product" width='20%'>Product</td>
                            <td class="size">Size</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="amount">Amount</td>
                            <td class="total">Total</td>
                            <td class="update"> Update</td>
                            <td width='5%'><i class="ti-close"></i>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>

                        @foreach (Cart::instance(Auth::user()->id)->content() as $key => $item)

                        <tr>
                            <td class="id">{{ $i+1 }}</td>
                            <td class="cart_image">
                                <a href="{{ route('productdetail', $item->id) }}"><img
                                        src="data:image;base64, {{ $item->options->img }}" alt="{{ $item->name }}"
                                        width="100px"></a>
                            </td>
                            <td class="cart_product">
                                <h4><a href="{{ route('productdetail', $item->id) }}">{{ $item->name }}</a></h4>
                            </td>
                            <td class="cart_size">
                                <h4>


                                    {{ $item->options->namesize }}

                                </h4>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($item->price) }} vnd</p>
                            </td>


                            <td class="cart_quantity">

                                <div class="quantity">
                                    <div class="form-group">
                                        <input type="number" name="qty" class="form-control qty"
                                            value="{{ $item->qty }}" min='1' data-id="{{ $item->rowId }}"
                                            id="quantityItem{{ $item->rowId }}">
                                    </div>
                                </div>

                            </td>



                            <td class=" cart_amount">
                                <input type="hidden" name="check_availability" value="{{ $amount_product[$i] }}">
                                {{ $amount_product[$i] }}
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ number_format($item->total) }}</p>
                            </td>
                            <td class="cart_update">
                                <a type="submit" onclick="return confirm('Are you sure to update?')"><i data-id="{{ $item->rowId }}" id="save{{ $item->rowId }}"
                                        class="fa fa-save"></i></a>
                            </td>
                            <td class=" cart_delete">
                                <a type="submit" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-times fa-lg" data-id="{{ $item->rowId }}"></i></a>
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
        @if(Cart::instance(Auth::user()->id)->count() != 0)
        <div class="row">
            <div class="col-lg-4">
                <div class="cart-buttons">
                    {{-- <a href="{{ route('shop') }}" class="primary-btn continue-shop">Continue
                    shopping</a><br> --}}
                    <h4>Shipping address:</h4> <br />
                    <span>{{ Auth::user()->address }}</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#myModal">Change</button>
                    <br><br>
                    <h4>Phone number:</h4> <br />
                    <span>Phone: +84 {{ Auth::user()->phone }}</span><br /><br />
                    <h4>Email: </h4> <br />
                    <span>Email&nbsp;: {{ Auth::user()->email }}</span>

                    {{-- <a href="#" class="primary-btn up-cart">Update cart</a> --}}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="discount-coupon">
                    <h6>Payment methods</h6>
                    <div>
                        <label><input type="radio" name="payment" value="Payment on delivery" class="red" checked>
                            Payment on
                            delivery</label> <br />
                        <div class="red card box" style="display: block">It may take<strong> 2-4 days
                            </strong>for
                            delivery
                        </div>
                        <label><input type="radio" name="payment" value="Pay by credit card" class="green">
                            Pay by credit card</label> <br />
                        <div class="green card box">Transfer funds to the following account number:
                            <br>- Account number: 123 456 78910
                            <br>- Owner ATM: Le Dang Khoi
                            <br>- Bank Vietinbank, Hue
                        </div>
                    </div>
                </div>
                <div class="discount-coupon">
                    <h6>Discount Codes</h6>
                    <button type="button" class="btn btn-primary proceed-btn" style="width: 100%" data-toggle="modal"
                        data-target="#exampleModal1">
                        Enter the discount code
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="proceed-checkout">
                    <ul>
                        <li class="subtotal">Current price:
                            <span>{{ number_format(Cart::instance(Auth::user()->id)->total()) }}
                                VND</span></li>
                        <li class="cart-total" style="font-size: 20px;">Total price:
                            <span>{{ number_format(Cart::instance(Auth::user()->id)->total()) }}VND</span>
                        </li>
                    </ul>

                    <button type="button" class="btn btn-primary proceed-btn" style="width: 100%" data-toggle="modal"
                        data-target="#exampleModal">
                        PROCEED TO CHECK OUT
                    </button>

                    <!-- Modal PROCEED TO CHECK OUT -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel" style="color:blue;">Confirm
                                        your bills</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure this information is correct? <br>
                                    We will send an email to confirm your order!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Confirm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        @endif

    </div>

</section>
<!-- Shopping Cart Section End -->



<!-- Modal address -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('change_address') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" style="color: blue; margin: auto">Change
                        address</h3>
                </div>
                <div class="modal-body">
                    <p>Current adddress: <b>{{ Auth::user()->address }}</b></p>
                    <p>New shipping address: <input type="text" placeholder="Address" name="address"
                            class="form-control">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Change">
                </div>
            </div>
        </form>
    </div>

</div>
<!--/#do_action-->
