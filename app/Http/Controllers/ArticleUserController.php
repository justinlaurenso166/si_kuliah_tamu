<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleUserController extends Controller
{
    public function index(Request $request) # fungsi index untuk menampilkan data artikel yang ada di database dan menampilkan halaman index artikel di halaman user
    {//post, post dokumentasi, dokumentasi,foto
        $search = $request->get('search');
        if ($search) {
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
            return view('website-for-user.article.article', [
                'title' => 'Artikel - Pradita University\'s Guest Lecturers',
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

        $total = count($posts);
        $per_page = 5;
        $current_page = $request->input("page") ?? "1";
        $starting_point = ($current_page * $per_page) - $per_page;
        $posts = array_slice($posts, $starting_point, $per_page);
        $paginate = new \Illuminate\Pagination\LengthAwarePaginator($posts, $total, $per_page, $current_page, ['path' => $request->url(), 'query' => $request->query()]);
        // $posts = Posts::filter(request(['search']))->join('posts_dan_dokumentasi', 'posts.id_posts', '=', 'posts_dan_dokumentasi.id_posts') # mengambil data artikel yang ada di database dan mengambil data dokumentasi yang ada di database dan mengambil data foto yang ada di database
        // ->join('dokumentasi', 'posts_dan_dokumentasi.id_dokumentasi', '=', 'dokumentasi.id_dokumentasi')
        // ->join('foto', 'dokumentasi.id_dokumentasi', '=', 'foto.id_dokumentasi')->paginate(5)->withQueryString(); // paginasi data artikel dan dokumentasi dan foto dengan 5 data per halaman dan menampilkan query string
        return view('website-for-user.article.article',[
            'title' => 'Article - Pradita University\'s Guest Lecturers',
            'posts' => $paginate,
        ]); # mengembalikan view article dengan parameter title dan posts
    }

    public function show($id) # fungsi show untuk menampilkan data artikel yang ada di database dan menampilkan halaman detail artikel di halaman user
    {
        $post = DB::select('SELECT * FROM posts, posts_dan_dokumentasi, dokumentasi, foto WHERE posts.id_posts = posts_dan_dokumentasi.id_posts AND posts_dan_dokumentasi.id_dokumentasi = dokumentasi.id_dokumentasi AND dokumentasi.id_dokumentasi = foto.id_dokumentasi AND posts.id_posts = ?', [$id]); # mengambil data artikel yang ada di database dan mengambil data dokumentasi yang ada di database dan mengambil data foto yang ada di database
        return view('website-for-user.article.article-inside',[
            'title' => 'Posts - Pradita University\'s Guest Lecturers',
            'post' => $post
        ]);
    }
}
