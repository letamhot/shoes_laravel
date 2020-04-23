@extends('shoes.partials.layout')

@section('title', 'Product-Detail')

@section('content')
<section>
    <div class="container">

        @include('partials.message')

        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        <div class="panel panel-default">

                            <div id="sportswear" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach ($types as $type)
                                        <li><a href="">{{ $type->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @foreach ($types as $type)
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                        <span class="badge pull-right"><i
                                                class="fa fa-plus"></i></span>{{ $type->name }}
                                    </a>
                                </h4>
                            </div>
                            <div id="men" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach ($products as $product)
                                        @if($product->id_type = $type->id)
                                        <li><a href="">{{ $product->name }}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--/category-products-->

                    <div class="brands_products">
                        <!--brands_products-->
                        <h2>Product</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <span class="pull-right">Amount
                                    </span>Product
                                </li>
                            </ul>
                            @foreach ($products as $product)
                            <ul class="nav nav-pills nav-stacked">

                                <li><a href="{{ route('productdetail', $product->id) }}">
                                        <span class="pull-right">{{ $id_product->size_product->sum('qty') }}
                                        </span>{{ $product->name }}
                                    </a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                    <!--/brands_products-->
                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="data:image;base64, {{ $id_product->image }}" alt="" />
                            <h3>Product Zoom</h3>
                        </div>
                        {{-- <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div> --}}

                    </div>
                    <div class="col-sm-7">
                        <input type="hidden" value="{{ $id_product->size_product->sum('qty') }}">


                        <div class="product-information">
                            <!--/product-information-->
                            <img src="images/product-details/new.jpg" class="newarrival" alt="" />

                            @if($id_product->size_product->sum('qty') < 1) <h2
                                style='color: white; font-size: 30px; font-weight: bold; border: solid red; max-width: 230px; text-align: center; background: red;'>
                                Out of stock</h2>

                                <h2>{{ $id_product->name }}</h2>
                                <p><b>Type:</b> {{ $id_product->type->name }}</p>
                                <span>
                                    <span
                                        style="text-decoration: line-through; color: #b2b2b2">{{ number_format($id_product->price_input) }}
                                        vnđ</span>
                                </span>
                                @else
                                <h2>{{ $id_product->name }}</h2>
                                <p><b>Type:</b> {{ $id_product->type->name }}</p>


                                <span>
                                    @if($id_product->promotion_price > 0)
                                    <span>{{ number_format($id_product->promotion_price) }} vnđ</span>

                                    <span
                                        style="text-decoration: line-through">{{ number_format($id_product->price_input) }}
                                        vnđ</span>
                                    @else
                                    <span>{{ number_format($id_product->price_input) }} vnđ</span>
                                    @endif



                                </span>
                                <div class="sc-item">
                                    Size:

                                    @foreach ($id_product->size_product as $size_name)

                                    <input id="size" onclick="sizes({{ $size_name->id_size }})" type="radio"
                                        name="size_name" class="size-select1"
                                        value="{{ $size_name->size->name }}" />{{ $size_name->size->name }}

                                    @endforeach
                                    <br>

                                    <div>
                                        <input type="text" value="1" style="display: flex; width: 60px;"
                                            class="qtyexample" data-id=" {{ $id_product->size_product->sum('qty') }}"
                                            name="qty" />
                                        @foreach ($id_product->size_product as $key => $size_name)
                                        <input type="text" value="1" style="display: flex; width: 60px;"
                                            class="equipCatValidation {{ $size_name->size->name }}" name="qty"
                                            id="{{ $size_name->size->id }}" data-id{{ $key }}="{{ $size_name->qty }}">
                                        @endforeach

                                        @foreach ($id_product->size_product as $size_name)

                                        <div class="sc-item" style="font-weight: bold; color: #757575">
                                            <span class="{{ $size_name->size->name }} qtyavailable">{{ $size_name->qty . " products
                                        available" }}</span>
                                        </div>

                                        @endforeach
                                    </div>
                                </div>
                                <div style="margin-top: 20px;">

                                    @if($id_product->size_product->sum('qty') > 0)
                                    <a onclick="AddCartPost({{ $id_product->id }})" class="btn btn-default add-to-cart"
                                        style="border: none" href="javascript:"><i class="fa fa-shopping-cart"></i>Add
                                        To Cart</a>
                                    @else
                                    <a href="javascript:window.location.href=window.location.href"
                                        class="btn primary-btn pd-cart disabled" aria-disabled="true">Add To
                                        Cart</a>
                                    @endif
                                </div>
                                <input type="hidden" id="check_stock" name="check_stock"
                                    value="{{ $id_product->size_product->sum('qty') }}" style="display: flex">
                                <p style="padding-top: 20px;" id="quantity" name="qty"><b>Amount:</b>
                                    {{ $id_product->size_product->sum('qty') }} product</p>
                                <p><b>Status:
                                        @if( $id_product->new == 1)
                                    </b> New</p>
                                @else
                                </b> Current</p>
                                @endif
                                <p><b>Brand:</b> {{ $id_product->producer->name }}</p>
                                {{-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                                alt="" /></a> --}}

                                @endif
                        </div>
                        {{--  </form>  --}}

                        <!--/product-information-->
                    </div>
                </div>
                <!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Details</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{ count($review) }})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details">
                            @foreach ($products as $product)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{ route('productdetail', $product->id) }}"><img
                                                    src="data:image;base64, {{ $product->image }}" alt="" /></a>
                                            <h2>{{ $product->price_input }}</h2>
                                            <a href="{{ route('productdetail', $product->id) }}"
                                                class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to
                                                cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Your Name" />
                                        <input type="email" placeholder="Email Address" />
                                    </span>
                                    <textarea name=""></textarea>
                                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/category-tab-->

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">List items</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">

                                @foreach ($product1 as $product)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ route('productdetail', $product->id) }}">
                                                    @if($id_product->size_product->sum('qty') > 0)
                                                    <img src="data:image;base64, {{ $product->image }}" alt=""
                                                        height="180px" /></a>
                                                @else
                                                <img src=" data:image;base64, {{ $product->image }}" alt=""
                                                    height="180px" style="-webkit-filter: blur(2px);" /></a>
                                                @endif
                                                @if($id_product->size_product->sum('qty') > 0)
                                                <h2>{{ number_format($product->price_input) }} VND</h2>

                                                <input type="hidden" value="{{ $id_product->size_product->sum('qty') }}"
                                                    name="check_stock">

                                                <a href="{{ route('productdetail', $product->id) }}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to
                                                    cart</a>

                                                @else

                                                <h2><span style="color:red">Out of stock</span> <br>
                                                    <span
                                                        style="color: #b2b2b2; text-decoration: line-through">{{ number_format($product->price_input) }}
                                                        VND</span></h2>

                                                @endif
                                                {{--  </form>  --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>

                            <div class="item">

                                @foreach ($product2 as $item)

                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="data:image;base64, {{ $item->image }}"
                                                    alt="{{ $item->name }}" />
                                                <h2>{{ number_format($item->price_input) }} VND</h2>
                                                <a href="{{ route('cart') }}" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>
@endsection
@push('qty')
<script>
    $('.equipCatValidation').on('keyup keydown', function(e){
        for(i = 0; i < 100; i++) {
            var availability = $(this).data("id"+i);
            console.log(availability);
            var KeysPressedTrue = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 46, 8, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123].indexOf(e.which) > -1;
            if(!KeysPressedTrue) {
                return false;
            }
            if ($(this).val() > availability) {
                e.preventDefault();
                $(this).val(availability);
            }
        }
    });
    $('.qtyexample').on('keyup keydown', function(e){
        var totalqty = $(this).data("id");
        var KeysPressedTrue = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 46, 8, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123].indexOf(e.which) > -1;
        if(!KeysPressedTrue) {
            return false;
        }
        if ($(this).val() > totalqty) {
            e.preventDefault();
            $(this).val(totalqty);
        }
    });
</script>
@endpush
