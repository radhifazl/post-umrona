<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::orderByDesc('created_at')->paginate(5);

        if ($post == null) {
            return response()->json([
                'message' => 'No post found'
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Daftar data post',
                'posts' => $post
            ], 200);
        }
    }

    public function show($id)
    {
        $post = Post::find($id);

        if ($post == null) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Detail data post',
                'post' => $post
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'author' => $request->author,
            'title' => $request->title,
            'content' => $request->content
        ]);

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil di tambahkan',
                'post' => $post
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post gagal di tambahkan',
            ], 400);
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post == null) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        if ($post->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil di hapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post gagal di hapus',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if ($post == null) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        $post->author = $request->author;
        $post->title = $request->title;
        $post->content = $request->content;

        if ($post->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil di update',
                'post' => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post gagal di update',
            ], 500);
        }
    }
}
