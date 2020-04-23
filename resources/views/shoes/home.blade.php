@extends('shoes.partials.layout')

@section('title', 'Home')

@section('content')


<section id="slider">
    <!--slider-->

    <div class="container">


        @include('partials.message')

        <div class="row">

            <div class="col-sm-12">

                <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>Asics</span>& Mizuno</h1>
                                <h2>Asics & Mizuno chính hãng</h2>
                                <p>Specializing in providing genuine asics and mizuno shoes. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                @if(!empty($slides->image))
                                <img src="data:image;base64, {{ $slides->image }}" style="margin-left: 150px;"
                                    width="300px" height="300px" class="girl img-responsive" alt="" />
                                @endif
                            </div>
                        </div>
                        @foreach ($slides1 as $slide)
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>Asics</span>& Mizuno</h1>
                                <h2>Asics & Mizuno chính hãng</h2>
                                <p>Specializing in providing genuine asics and mizuno shoes. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="data:image;base64, {{ $slide->image }}" style="margin-left: 150px;"
                                    width="300px" height="300px" class="girl img-responsive" alt="" />
                                {{-- <img src="images/home/pricing.png" class="pricing" alt="" /> --}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

</section>
<!--/slider-->

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
                    <!--/category-products-->

                    <div class="brands_products">
                        <!--brands_products-->
                        <h2>Brands</h2>
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
                                        <span class="pull-right">{{ $product->amount }}
                                        </span>{{ $product->name }}
                                    </a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                    <!--/brands_products-->

                    <div class="price-range">
                        <!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div>
                    <!--/price-range-->

                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->

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
                                        @if($size_product[$i]->qty > 0)
                                        <img src="data:image;base64, {{ $product->image }}" alt="" height="180px" /></a>
                                    @else
                                    <img src="data:image;base64, {{ $product->image }}" alt="" height="180px"
                                        style="-webkit-filter: blur(2px);" /></a>
                                    @endif

                                    {{-- <form action="{{ route('AddShoppingCart', $product->id) }}" method="GET">
                                    @csrf --}}
                                    @if($size_product[$i]->qty > 0)
                                    <h2>{{ number_format($product->price_input) }} VND</h2>

                                    <input type="hidden" value="{{ $size_product[$i]->qty }}" name="check_stock">

                                    <a href="{{ route('productdetail', $product->id) }}"
                                        class=" btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                        cart</a>

                                    @else

                                    <h2><span style="color:red">Out of stock</span> <br>
                                        <span
                                            style="color: #b2b2b2; text-decoration: line-through">{{ number_format($product->price_input) }}
                                            VND</span></h2>

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

                <!--/category-tab-->

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">List items</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php $i = 0 ;?>

                                @foreach ($product1 as $product)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ route('productdetail', $product->id) }}">
                                                    @if($size_product[$i]->qty > 0)
                                                    <img src="data:image;base64, {{ $product->image }}" alt=""
                                                        height="180px" /></a>
                                                @else
                                                <img src=" data:image;base64, {{ $product->image }}" alt=""
                                                    height="180px" style="-webkit-filter: blur(2px);" /></a>
                                                @endif

                                                {{-- <form action="{{ route('addCart', $product->id) }}" method="GET">
                                                @csrf --}}
                                                @if($size_product[$i]->qty > 0)
                                                <h2>{{ number_format($product->price_input) }} VND</h2>

                                                <input type="hidden" value="{{ $size_product[$i]->qty }}"
                                                    name="check_stock">

                                                <a href="{{ route('productdetail', $product->id) }}"
                                                    class=" btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to
                                                    cart</a>

                                                @else

                                                <h2><span style="color:red">Out of stock</span> <br>
                                                    <span
                                                        style="color: #b2b2b2; text-decoration: line-through">{{ number_format($product->price_input) }}
                                                        VND</span></h2>

                                                @endif
                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++?>

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
                                                <a href="{{ route('productdetail', $product->id) }}" class=" btn
                                                    btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                                    cart</a>
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
