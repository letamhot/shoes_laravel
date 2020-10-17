@extends('shoes.partials.layout')

@section('title', 'Shop')

@section('content')
<section id="advertisement">
    <div class="container">
        <img src="images/shop/advertisement.jpg" alt="" />
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        @foreach ($types as $type)

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">{{ $type->name }}</a></h4>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    <!--/category-productsr-->

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
                                        <span class="pull-right">{{ $product->size_product->sum('qty') }}
                                        </span>{{ $product->name }}
                                    </a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <?php $i = 0 ;?>
                    <h2 class="title text-center">Product Items</h2>
                    @foreach ($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper" style="margin-bottom: 10px">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ route('productdetail', $product->id) }}">
                                    @if($product->size_product->sum('qty') > 0)
                                        <img src="data:image;base64, {{ $product->image }}" alt="" height="180px" /></a>
                                    @else
                                    <img src="data:image;base64, {{ $product->image }}" alt="" height="180px"
                                        style="-webkit-filter: blur(2px);" /></a>
                                    @endif

                                    {{-- <form action="{{ route('AddShoppingCart', $product->id) }}" method="GET">
                                    @csrf --}}
                                    @if($product->size_product->sum('qty') > 0)
                                    <h2>{{ number_format($product->price_input) }} VND</h2>

                                    <input type="hidden" value="{{ $product->size_product->sum('qty') }}"
                                        name="check_stock">

                                    <a href="{{ route('productdetail', $product->id) }}"
                                        class=" btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                        cart</a>

                                    @else

                                    <h2><span style="color:red">Out of stock</span> <br>
                                        <span
                                            style="color: #b2b2b2; text-decoration: line-through">{{ number_format($product->price_input) }}
                                            VND
                                        </span>
                                    </h2>

                                    @endif
                                    {{-- </form> --}}
                                </div>
                            </div>

                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php $i++?>
                    @endforeach

                </div>
                <!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection
