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
                            <li><a href="#details" data-toggle="tab" role="tab">Details</a></li>
                            <li>
                                <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                            </li>
                            <li class="active"><a href="#reviews" data-toggle="tab" role="tab">Reviews
                                    ({{ count($review) }})</a>
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
                                            <a href="{{ route('productdetail', $product->id) }}">
                                                @if($product->size_product->sum('qty') > 0)

                                                <img src="data:image;base64, {{ $product->image }}" alt="" /></a>
                                            @else
                                            <img src="data:image;base64, {{ $product->image }}" alt=""
                                                style="-webkit-filter: blur(2px);" /></a>
                                            @endif
                                            @if($product->size_product->sum('qty') > 0)
                                            <h2>{{ $product->price_input }}</h2>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="tab-2" role="tabpanel">
                            <div class="specification-table">
                                <table>
                                    <tr>
                                        <td class="p-catagory">Customer Rating</td>
                                        <td>
                                            <div class="pd-rating">
                                                {{ round($avgRating, 1) }}
                                                @if($avgRating == 0)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                @elseif($avgRating > 0 && $avgRating < 0.9) <i
                                                    class="fa fa-star-half-alt">
                                                    </i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    @elseif($avgRating >= 1 && $avgRating < 1.1) <i class="fa fa-star">
                                                        </i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        @elseif($avgRating >= 1.1 && $avgRating < 2) <i
                                                            class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            @elseif($avgRating >= 2 && $avgRating < 2.1) <i
                                                                class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                @elseif($avgRating >= 2.1 && $avgRating < 3) <i
                                                                    class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-alt"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    @elseif($avgRating >= 3 && $avgRating < 3.1) <i
                                                                        class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        @elseif($avgRating >= 3.1 && $avgRating < 4) <i
                                                                            class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-half-alt"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            @elseif($avgRating >= 4 && $avgRating < 4.1)
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                @elseif($avgRating >= 4.1 &&
                                                                                $avgRating < 5) <i class="fa fa-star">
                                                                                    </i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star-half-alt"></i>
                                                                                    @else
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    @endif
                                                                                    <span>
                                                                                        ({{ count($countRating) }}
                                                                                        Rating)</span>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-catagory">Price</td>
                                        <td>
                                            <div class="p-price">

                                                @if($id_product->promotion_price < $id_product->price_input &&
                                                    $id_product->promotion_price > 0)
                                                    {{ number_format($id_product->promotion_price) }} VND
                                                    @else
                                                    {{ number_format($id_product->price_input) }} VND
                                                    @endif

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-catagory">Availability</td>
                                        <td>
                                            <div class="p-stock">{{ $id_product->size_product->sum('qty') }} in
                                                stock</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-catagory">Size</td>
                                        <td>
                                            <div class="p-size"> @foreach ($id_product->size_product as $size)
                                                {{ $size->size->name }} &nbsp;
                                                @endforeach</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <img src="data:image;base64, {{ $id_product->image }}" style=" aligh:center;width: 60rem;
                                    height: 40rem;" alt="" />
                                <br>
                                <p aligh:"center">{!! $id_product->description !!}</p>

                                @if(Auth::user())

                                <div class="leave-comment">
                                    <h4>Leave A Comment</h4>

                                    <!-- Form reviews -->
                                    <form action="{{ route('reviews')}}" method="POST" class="comment-form"
                                        id="my-form2">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="id_product" value="{{ $id_product->id }}">
                                            <div class="col-lg-1">
                                                Rating
                                            </div>
                                            <input id="input-1" name="input-1" class="rating rating-loading"
                                                data-min="0" data-max="5" data-step="0.1"
                                                value="{{ $reviews->averageRating }}" data-size="xs" disabled="">
                                            <div style="margin-left: 1rem">
                                                <span class="stars"></span>
                                            </div>
                                            <div class="col-lg-12">
                                                <textarea id="comment" placeholder="Messages" name="comment" rows="5"
                                                    maxlength="250"
                                                    style="margin-bottom: 10px">{{ old('comment') }}</textarea>
                                                <div id="the-count_comment" style="margin-bottom: 30px">
                                                    <span id="current_comment">0</span>
                                                    <span id="maximum_comment"> / 250</span>
                                                </div>
                                                <button type="submit" class="site-btn" id="btn-submit2"
                                                    style="border: none">Send
                                                    message</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                @endif
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
                                                    @if($product->size_product->sum('qty') > 0)
                                                    <img src="data:image;base64, {{ $product->image }}" alt=""
                                                        height="180px" /></a>
                                                @else
                                                <img src=" data:image;base64, {{ $product->image }}" alt=""
                                                    height="180px" style="-webkit-filter: blur(2px);" /></a>
                                                @endif
                                                @if($product->size_product->sum('qty') > 0)
                                                <h2>{{ number_format($product->price_input) }} VND</h2>

                                                <input type="hidden" value="{{ $product->size_product->sum('qty') }}"
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
                                                <a href="{{ route('productdetail', $item->id) }}">
                                                    @if($item->size_product->sum('qty') > 0)
                                                    <img src="data:image;base64, {{ $item->image }}" alt=""
                                                        height="180px" /></a>
                                                @else
                                                <img src=" data:image;base64, {{ $item->image }}" alt="" height="180px"
                                                    style="-webkit-filter: blur(2px);" /></a>
                                                @endif
                                                @if($item->size_product->sum('qty') > 0)
                                                <h2>{{ number_format($item->price_input) }} VND</h2>

                                                <input type="hidden" value="{{ $item->size_product->sum('qty') }}"
                                                    name="check_stock">

                                                <a href="{{ route('productdetail', $item->id) }}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to
                                                    cart</a>

                                                @else

                                                <h2><span style="color:red">Out of stock</span> <br>
                                                    <span
                                                        style="color: #b2b2b2; text-decoration: line-through">{{ number_format($item->price_input) }}
                                                        VND</span></h2>

                                                @endif
                                                {{--  </form>  --}}
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
<script type="text/javascript">

    $("#input-id").rating();

</script>
@endsection
@push('qty')
<script src="js/zoom-image.js"></script>
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
<script>
    $(document).ready(function() {
  $('label').click(function() {
    $('label').removeClass('active');
    $(this).addClass('active');
  });
 });
</script>
<script>
    $(document).ready(function(){
      $("#star5").click(function(){
        $(".stars").html("<b style='color: orange'>Excellent</b>");
      });
      $("#star4").click(function(){
        $(".stars").html("<b style='color: green'>Very good</b>");
      });
      $("#star3").click(function(){
        $(".stars").html("<b style='color: blue'>Normal</b>");
      });
      $("#star2").click(function(){
        $(".stars").html("<b style='color: red'>Bad</b>");
      });
      $("#star1").click(function(){
        $(".stars").html("<b style='color: #A52A2A'>Very bad</b>");
      });
    });
</script>
<script>
    $('#comment').keyup(function() {
        var characterCount = $(this).val().length,
            current = $('#current_comment'),
            maximum = $('#maximum_comment'),
            theCount = $('#the-count_comment');
        var maxlength = $(this).attr('maxlength');
        var changeColor = 0.75 * maxlength;
        current.text(characterCount);

        if (characterCount > changeColor && characterCount < maxlength) {
            current.css('color', '#FF4500');
            current.css('fontWeight', 'bold');
        } else if (characterCount >= maxlength) {
            current.css('color', '#B22222');
            current.css('fontWeight', 'bold');
        } else {
            var col = maximum.css('color');
            var fontW = maximum.css('fontWeight');
            current.css('color', col);
            current.css('fontWeight', fontW);
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#my-form").submit(function (e) {
            $("#btn-submit").attr("disabled", true);
            $("#btn-submit").addClass('button-clicked');
            return true;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#my-form2").submit(function (e) {
            $("#btn-submit2").attr("disabled", true);
            $("#btn-submit2").addClass('button-clicked');
            return true;
        });
    });
</script>
@endpush