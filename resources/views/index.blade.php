@extends('template')

@section('others_head')
    <title>fu-minblog | 趣味を呟く雑記ブログ</title>
    <meta property="og:title" content="fu-minblog | 趣味を呟く雑記ブログ">
    <meta property="og:description" content="fu-minblogは、プログラミング技術から旅行・ゲームなどの趣味の話、ふと思ったことまで、様々な経験を記事にしている雑記ブログです。できるだけ有益な情報を提供しております。">
    <meta property="og:image" content="{{ Storage::url('images/ogp/ogp-default.png') }}">
@endsection

@section('content')
<main class="toppage">

<section class="about" id="about">
    <div class="title-area">
        <h2 class="title">ABOUT</h2>
        <p class="title-jp">ブログ概要</p>
    </div>
    <div class="content">
        <p class="text">
            管理人が喋りたいと思ったことを喋るだけの所謂<b>雑記ブログ</b>です。<br>
            それでもできるだけ有益な情報を提供するつもりです。多分。<br>
            尚、このブログはLaravel(PHPフレームワーク)を用いたWordpress等CMSに頼っていない自作サイトです。
        </p>
        <dl class="desc-list">
            <p class="desc-title">主な投稿内容</p>
            <div>
                <dt>旅行関連:</dt>
                <dd>日本国内の旅行記録を写真と共に紹介</dd>
            </div>
            <div>
                <dt>プログラミング:</dt>
                <dd>初心者プログラマーによるWebアプリ開発奮闘記</dd>
            </div>
            <div>
                <dt>ゲーム関連:</dt>
                <dd>主に音ゲーやアイドルマスターのお話。</dd>
            </div>
            <div>
                <dt>その他:</dt>
                <dd>日常や考えていることなどを雑に呟きます。</dd>
            </div>
        </dl>
    </div>
</section>

<section class="recent" id="recent">
    <div class="title-area">
        <h2 class="title">RECENT</h2>
        <p class="title-jp">最近の投稿</p>
    </div>
    <div class="content">
        <ul class="post-list">
            @foreach ($recentPosts as $post)
            <li>
                <a href="{{ asset('show/' . $post->post_id) }}" class="text-black">
                    <div class="img-area">
                        <img src="{{ Storage::url($post->ogp) }}" class="text-black">
                    </div>
                    <div class="text-area">
                        <h3>{{ $post->post_title }}</h3>
                        <p>{{ $post->post_desc }}</p>
                        <div class="post-time">
                            <p>投稿日: {{ $post->created_at }}</p>
                            <p>更新日: {{ $post->updated_at }}</p>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="profile" id="profile">
    <div class="title-area">
        <h2 class="title">PROFILE</h2>
        <p class="title-jp">管理人自己紹介</p>
    </div>
    <div class="content">
        <dl class="desc-list">
            <div>
                <dt>名前:</dt>
                <dd>Fumiya</dd>
            </div>
            <div>
                <dt>出身:</dt>
                <dd>静岡県沼津市。ラブライブサンシャインの聖地ですが、アニメは見たことないです。</dd>
            </div>
            <div>
                <dt>年齢・所属:</dt>
                <dd>21歳、1浪ののち地方国公立大学に進学、現在3年生。</dd>
            </div>
            <div>
                <dt>趣味:</dt>
                <dd>音ゲー(主にオンゲキ)、アイマス(主にミリオン)、一人旅、プログラミング</dd>
            </div>
            <div>
                <dt>特技:</dt>
                <dd>反射神経、<small><s>妄想</s></small>想像力、自分を客観的に見れる</dd>
            </div>
            <div>
                <dt>苦手なこと:</dt>
                <dd>
                    大量の情報を1度に処理すること(マルチタスク)、咄嗟の判断
                </dd>
            </div>
            <div>
                <dt>好物:</dt>
                <dd>海鮮類全般(特に刺身)、小豆と抹茶。あとさわやかのハンバーグ。</dd>
            </div>
        </dl>
    </div>
</section>

<section class="career" id="career">
    <div class="title-area">
        <h2 class="title">CAREER</h2>
        <p class="title-jp">管理人経歴</p>
    </div>
    <div class="content">
        <small><s>別にキャリアではない</s></small>
        <dl class="desc-list">
            <div>
                <dt>2000年:</dt>
                <dd>静岡県沼津市に生まれる。</dd>
            </div>
            <div>
                <dt>2006年:</dt>
                <dd>初めてPCに触る。確かDORAっていうよく分からん教育ゲームやってた。</dd>
            </div>
            <div>
                <dt>2014年:</dt>
                <dd>PCを買ってもらい本格的にPCに没頭する。その結果6月ごろから中学不登校に。</dd>
            </div>
            <div>
                <dt>2015年:</dt>
                <dd>友人の助けで中学復帰。この時期が一番青春だったかもしれない。</dd>
            </div>
            <div>
                <dt>2016年～:</dt>
                <dd>「虚無」の一言で表せる高校時代。プログラミング的に言えばNULL。</dd>
            </div>
            <div>
                <dt>2019年:</dt>
                <dd>
                    スーパーの鮮魚部でバイトしながら浪人生活。<br>
                    自分の将来像を深く考える機会になった。あと魚が超好きになった。
                </dd>
            </div>
            <div>
                <dt>2020年:</dt>
                <dd>
                    情報科の大学入学。<br>
                    同年9月頃から<s>やっと</s>独学でプログラミングを始める。
                </dd>
            </div>
            <div>
                <dt>2021年:</dt>
                <dd>
                    ITベンチャー企業でアルバイトをする(1年間)。<br>
                    Web制作やシステム開発の基礎的なノウハウを得られた。
                </dd>
            </div>
        </dl>
    </div>
</section>

@if(Auth::check())
<div class="link-area">
    <a href="./articles/index">記事一覧</a>
    <a href="./articles/create">記事投稿</a>
</div>
@endif
</main>
@endsection

@section('script')
<script></script>
@endsection
