<header class="h-full bg-brown text-white box-border">
<div class="header-content flex justify-between items-center max-w-7xl">
    <section class="header-title font-heading w-1/5">
        <a href="{{ url('/') }}" class="hover:no-underline">
            <p class="blog-name text-5xl">Fu-minBlog</p>
            <p class="blog-desc text-xs">趣味を呟く雑記ブログ</p>
        </a>
    </section>
    <nav class="header-nav w-2/5 text-center mx-auto">
        <ul class="flex justify-around">
            @foreach($global_nav as $gn)
                <li id="gnav-cats" class="text-lg px-3 mx-3">
                    <a href="{{ asset('/search/index?category=' . $gn['cat_slag']) }}" class="py-2 block hover:underline">
                        <p>{{ $gn['cat_name'] }}</p>
                    </a>
                    <ul id="gnav-gens" class="hidden">
                        @foreach($gn['genres'] as $ge)
                            <li>
                                <a href="{{ asset('/search/index?genre=' . $ge['gen_slag']) }}">
                                    <p>{{ $ge['gen_name'] }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
    <section class="search-box w-2/5 text-right">
        <form action="{{ asset('/search/index') }}" method="GET">
            @csrf
            <input
                class="p-2 text-left text-black outline-none"
                type="search"
                name="search"
                value="@if(isset($_GET['search'])) {{$_GET['search']}} @endif"
                placeholder=" 記事を検索"
            >
            <input type="submit" value="検索" class="btn-submit border-white hover:text-brown hover:bg-white">
        </form>
    </section>
    <section id="hamburger" class="mx-3">
        <div class="bar-area">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="content">

        </div>
    </section>
</div>
</header>
