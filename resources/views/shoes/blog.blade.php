@extends('shoes.partials.layout')

@section('title', 'Blog')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        Sportswear
                                    </a>
                                </h4>
                            </div>
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
                </div>
                <!--/category-products-->

                <div class="brands_products">
                    <!--brands_products-->
                    <h2>Product</h2>
                    <div class="brands-name">
                        @foreach ($products as $product)
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">
                                    <span class="pull-right">{{ $product->amount }}
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
        <div class="col-sm-9">
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From our Post</h2>
                @foreach ($posts as $post)
                <div class="single-blog-post">
                    <h3>{{ $post->title }}</h3>
                    <div class="post-meta">
                        <ul>
                            <li><i class="fa fa-user"></i>{{ $post->created_at }}</li>
                            {{-- <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                            <li><i class="fa fa-calendar"></i> DEC 5, 2013</li> --}}
                        </ul>
                        <span>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </span>
                    </div>
                    <a href="">
                        <img src="data:image;base64, {{ $post->image }}" width="845px" height="390px"
                            style=" width: 100%" alt="">
                    </a>
                    {{-- <p>{!! $post->content !!}</p> --}}
                    <a class="btn btn-primary" href="">Read More</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
