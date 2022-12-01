<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Posts;
use App\Models\PostsDanDokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            //later
            $posts = DB::select('SELECT dokumentasi.id_dokumentasi, posts.*, posts_dan_dokumentasi.id_posts , foto.* , event.*
            FROM dokumentasi
            INNER JOIN foto ON foto.id_foto =
            (SELECT foto.id_foto FROM foto WHERE dokumentasi.id_dokumentasi = foto.id_dokumentasi ORDER BY foto.id_dokumentasi ASC LIMIT 1 )
            INNER JOIN event ON event.id_event = dokumentasi.id_event
            INNER JOIN posts_dan_dokumentasi ON posts_dan_dokumentasi.id_dokumentasi = dokumentasi.id_dokumentasi
            INNER JOIN posts ON posts_dan_dokumentasi.id_posts = posts.id_posts
            AND ( judul LIKE ? OR ringkasan LIKE ? OR author LIKE ? ) GROUP BY posts_dan_dokumentasi.id_posts', ['%' . $search . '%', '%' . $search . '%', '%' . $search . '%']);

            $total = count($posts);
            $per_page = 5;
            $current_page = $request->input("page") ?? "1";
            $starting_point = ($current_page * $per_page) - $per_page;
            $posts = array_slice($posts, $starting_point, $per_page);
            $paginate = new \Illuminate\Pagination\LengthAwarePaginator($posts, $total, $per_page, $current_page, ['path' => $request->url(), 'query' => $request->query()]);
            return view('dashboard-admin.posts.detail-article.search-article',[
                'title' => 'Data Posts - Pradita University\'s Guest Lecturers',
                'posts' => $paginate,
            ]);
        }

        $posts = DB::select('SELECT dokumentasi.id_dokumentasi, posts.*, posts_dan_dokumentasi.id_posts , foto.* , event.*
        FROM dokumentasi
        INNER JOIN foto ON foto.id_foto =
        (SELECT foto.id_foto FROM foto WHERE dokumentasi.id_dokumentasi = foto.id_dokumentasi ORDER BY foto.id_dokumentasi ASC LIMIT 1 )
        INNER JOIN event ON event.id_event = dokumentasi.id_event
        INNER JOIN posts_dan_dokumentasi ON posts_dan_dokumentasi.id_dokumentasi = dokumentasi.id_dokumentasi
        INNER JOIN posts ON posts_dan_dokumentasi.id_posts = posts.id_posts

        GROUP BY posts_dan_dokumentasi.id_posts');

        // dd($posts);

        $total = count($posts);
        $per_page = 5;
        $current_page = $request->input("page") ?? "1";
        $starting_point = ($current_page * $per_page) - $per_page;
        $posts = array_slice($posts, $starting_point, $per_page);
        $paginate = new \Illuminate\Pagination\LengthAwarePaginator($posts, $total, $per_page, $current_page, ['path' => $request->url(), 'query' => $request->query()]);

        return view('dashboard-admin.posts.detail-article.search-article',[
            'title' => 'Data Posts - Pradita University\'s Guest Lecturers',
            'posts' => $paginate,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = DB::select('SELECT * FROM event, dokumentasi WHERE event.id_event = dokumentasi.id_event');
        return view('dashboard-admin.posts.input-article.create-article',[
            'title' => 'Input Posts - Pradita University\'s Guest Lecturers',
            'event' => $event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'judul' => 'required',
                'ringkasan' => 'required',
                'author' => 'required',
                // 'id_event' => 'required',
                'id_event.*' => 'required',
            ]);
            // dd($validatedData);
            $posts = [
                'judul' => $validatedData['judul'],
                'ringkasan' => $validatedData['ringkasan'],
                'author' => $validatedData['author'],
                'waktu_publikasi' => Carbon::now(),
            ];
            $idPost = Posts::create($posts)->id;

            for($i = 0; $i < count($validatedData['id_event']); $i++){
                $batchEvent[$i] = [
                    'id_posts' => $idPost,
                    'id_dokumentasi' => $validatedData['id_event'][$i]
                ];
            }
            PostsDanDokumentasi::insert($batchEvent);
            return redirect()->intended(route('post.index'))->with('success','Posts has been successfully added');
        } catch(\Exception $e){
            return redirect()->intended(route('post.index'))->with('error','Failed to add posts');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::select('SELECT * FROM posts, posts_dan_dokumentasi, dokumentasi, foto WHERE posts.id_posts = posts_dan_dokumentasi.id_posts AND posts_dan_dokumentasi.id_dokumentasi = dokumentasi.id_dokumentasi AND dokumentasi.id_dokumentasi = foto.id_dokumentasi AND posts.id_posts = ?', [$id]);
        return view('website-for-user.article.article-inside',[
            'title' => 'Posts - Pradita University\'s Guest Lecturers',
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::select('SELECT * FROM posts, posts_dan_dokumentasi, dokumentasi, event WHERE posts.id_posts = posts_dan_dokumentasi.id_posts AND posts_dan_dokumentasi.id_dokumentasi = dokumentasi.id_dokumentasi AND event.id_event = dokumentasi.id_event AND posts.id_posts = ? ', [$id]);
        return view('dashboard-admin.posts.edit-article.edit-article',[
            'title' => 'Posts - Pradita University\'s Guest Lecturers',
            'post' => $post
        ]);
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
        $validatedData = $request->validate([
            'judul' => 'required',
            'ringkasan' => 'required',
            'author' => 'required'
        ]);
        $posts = [
            'judul' => $validatedData['judul'],
            'ringkasan' => $validatedData['ringkasan'],
            'author' => $validatedData['author'],
            'waktu_pembaruan' => Carbon::now(),
        ];
        Posts::where('id_posts',$id)->update($posts);
        return redirect()->intended(route('post.index'))->with('success','Posts has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Posts::where('id_posts', $id);
        $posts->delete();
        return redirect()->intended(route('post.index'))->with('success','Posts has been successfully deleted');
    }
}
