{{-- Search --}}
<div class="col-6" style="float:right">
    <form class="navbar-form navbar-left" action="{{ route('posts.search') }}" method="get">
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Search"
                        value="{{ (isset($_GET['keyword'])) ? $_GET['keyword'] : '' }}">
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-default">Search</button>
            </div>
        </div>
    </form>
</div>