<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = DB::table('posts')
        ->select('post_id', 'post_slag', 'post_title', 'post_desc', 'post_content', 'ogp', 'watch_count', 'created_at', 'updated_at')
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        // dd($articles);
        return view('articles/index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('articles/create');
    }

    /**
     * Get genre list for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGenres()
    {
        //
        $genres = DB::table('genres')
        ->get();

        return view('articles/create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $gi = DB::table('genres')
        ->select('gen_id')
        ->where('gen_slag', $request->input('genre'))
        ->get();
        $gen_id = $gi[0]->gen_id;

        $img_path = null;
        // ogp画像をアップロードした場合、storage/app/public/ogp/内に保存
        if (isset($request->ogp) && $request->ogp !== '') {
            $ogp = $request->file('ogp');
            $img_path = $ogp->store('images/ogp', 'public');
        }

        $post = new Post;

        $post->post_slag = $request->input('slag');
        $post->gen_id = $gen_id;
        $post->post_title = $request->input('title');
        $post->post_author = 'fumiya';
        // Descriptionは、inputで登録しなかった場合記事内容の最初120文字とする
        $post->post_desc = isset($request->description) && $request->input('description') !== '' ? $request->input('description') : mb_substr($request->input('content'), 0, 115) . '...';
        $post->post_content = $request->input('content');
        $post->post_stats = $request->input('stats');
        $post->ogp = is_null($img_path) || $img_path === '' ? 'images/ogp/noimage.png' : $img_path;
        $post->watch_count = 0;

        $post->save();

        return redirect('articles/index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);

        // 該当記事が非公開・編集中の場合$postを返さない
        if ($post->post_stats !== 'public') {
            return view('show/index');
        }

        // ログインしていない場合の処理
        // 該当記事の閲覧回数を取得
        if (!Auth::check()) {
            $watch_counts = $post->watch_count;

            // 閲覧回数を1増やし更新
            $watch_counts++;
            $post->watch_count = $watch_counts;

            $post->save();
        }

        return view('show/index', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        // dd($post);

        $genres = DB::table('genres')
        ->get();

        return view('articles/edit', compact('post', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $gi = DB::table('genres')
        ->select('gen_id')
        ->where('gen_slag', $request->input('genre'))
        ->get();
        $gen_id = $gi[0]->gen_id;

        $img_path = null;
        // ogp画像をアップロードした場合、storage/app/public/ogp/内に保存
        if (isset($request->ogp) && $request->ogp !== '') {
            $ogp = $request->file('ogp');
            $img_path = $ogp->store('images/ogp', 'public');
        }

        $post = Post::find($id);

        $post->post_slag = $request->input('slag');
        $post->gen_id = $gen_id;
        $post->post_title = $request->input('title');
        $post->post_author = 'fumiya';
        // Descriptionは、inputで登録しなかった場合記事内容の最初120文字とする
        $post->post_desc = isset($request->description) && $request->input('description') !== '' ? $request->input('description') : mb_substr($request->input('content'), 0, 115) . '...';
        $post->post_content = $request->input('content');
        $post->post_stats = $request->input('stats');
        $post->ogp = is_null($img_path) || $img_path === '' ? 'images/ogp/noimage.png' : $img_path;

        $post->save();

        return redirect('articles/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();

        return redirect('articles/index');
    }
}
