@extends('template')

@section('content')
<main>
<h1>test</h1>
<p>Here is one of the Article of this blog!</p>
<a href="./create">新規登録</a>
@foreach ($articles as $article)
<p>{{ $article->post_title }}</p>
<p>{{ $article->created_at }}</p>
@endforeach
</main>
@endsection

@section('script')
<script></script>
@endsection