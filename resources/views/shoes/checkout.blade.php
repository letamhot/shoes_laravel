@extends('shoes.partials.layout')

@section('title', 'Check-Out')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('shoesHome') }}">Home</a></li>
                <li class="active"><a href="{{ route('checkoutGet') }}">Check out</li>
            </ol>
        </div>
        <!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        {{-- <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div> --}}
        <!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div>
        <!--/register-req-->

        <form action=" checkoutPost">
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="shopper-info">
                            <p>Shopper Information</p>
                            <input type="text" placeholder="Display Name" class="form-control">
                            <input type="text" placeholder="User Name" class="form-control">
                            <input type="password" placeholder="Password" class="form-control">
                            <input type="password" placeholder="Confirm password" class="form-control">
                            <a class="btn btn-primary" href="">Get Quotes</a>
                            <button type="submit" class="btn btn-primary">Continue</a>
                        </div>
                    </div>
                    <div class="col-sm-5 clearfix">
                        <div class="bill-to">
                            <p>Bill To</p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="fir">Full Name<span>*</span></label>
                                    <input type="text" id="fir" name="name" style="margin-bottom: 5px"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert" style="margin-bottom: 15px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- <div class="col-lg-6">
                                    <label for="last">Last Name<span>*</span></label>
                                    <input type="text" id="last">
                                </div> --}}
                                <div class="col-lg-12">
                                    <label for="cun-name">Email<span>*</span></label>
                                    <input type="text" id="cun-name" name="email" style="margin-bottom: 5px"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert" style="margin-bottom: 15px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun">Country<span>*</span></label>
                                    <input type="text" id="cun" name="country" style="margin-bottom: 5px"
                                        class="form-control @error('country') is-invalid @enderror"
                                        value="{{ old('country') }}">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert" style="margin-bottom: 15px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Street Address<span>*</span></label>
                                    <input type="text" id="street" name="address" style="margin-bottom: 5px"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address') }}">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert" style="margin-bottom: 15px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="zip">Postcode / ZIP (optional)</label>
                                    <input type="text" id="zip" name="postcode" style="margin-bottom: 5px"
                                        class="form-control @error('postcode') is-invalid @enderror"
                                        value="{{ old('postcode') }}">
                                    @error('postcode')
                                    <span class="invalid-feedback" role="alert" style="margin-bottom: 15px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="town">Town / City<span>*</span></label>
                                    <input type="text" id="town" name="city" style="margin-bottom: 5px"
                                        class="form-control @error('city') is-invalid @enderror"
                                        value="{{ old('city') }}">
                                    @error('city')
                                    <span class="invalid-feedback" role="alert" style="margin-bottom: 15px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="phone">Phone<span>*</span></label>
                                    <input type="text" id="phone" name="phone" style="margin-bottom: 5px"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert" style="margin-bottom: 15px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="create-item">
                                        <label for="acc-create">
                                            Create an account?
                                            <input type="checkbox" id="acc-create">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea name="message" placeholder="Notes about your order, Special Notes for Delivery"
                                rows="16"></textarea>
                            <label><input type="checkbox"> Shipping to bill address</label>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/one.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                    autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/two.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                    autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/three.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                    autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>$59</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>$61</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payment-options">
            <span>
                <label><input type="checkbox"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input type="checkbox"> Check Payment</label>
            </span>
            <span>
                <label><input type="checkbox"> Paypal</label>
            </span>
        </div>
    </div>
</section>
<!--/#cart_items-->
<!-- Shopping Cart Section End -->

@endsection

@push('cartjs')

<script>
    //Type radio show/hide
            $(document).ready(function(){
                $('input[type="radio"]').click(function(){
                    var inputValue = $(this).attr("class");
                    var targetBox = $("." + inputValue);
                    $(".box").not(targetBox).hide();
                    $(targetBox).show();
                });
            });
</script>

@endpush
