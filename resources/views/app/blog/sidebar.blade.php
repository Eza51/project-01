<div class="col-lg-4">
    <form action="">
        <div class="input-group review-searchbox mt_30">
            <label for="search"></label>
            <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" id="search" placeholder="Search for...">
            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <img src="{{ asset('app/img/icon_png/magnifying-glass%2032x32.png') }}" alt="">
                                </button>
                            </span>
        </div>
    </form>
    <div class="sidebar mt_15">
        <div class="sidebar-widget">
            <h4>Categories</h4>
            <ul>
                <li><a href="{{ route('blogs.index') }}">All Posts</a></li>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('blogs.index') . "?category=$category->slug" }}">{{ $category->name }}</a>
                        <span>({{ $category->blogs_count }})</span></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>