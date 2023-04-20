<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        // $allPost = Post::all('content', 'id');
        // $allPost = Post::where('id', '>', '1')
        //     ->get()
        //     ->reject(function ($post) {
        //         return $post->status == '1';
        //     });
        // // $post = new Post();
        // // $post->title = 'Post 7';
        // // $post->content = 'Content 7';
        // // $result = $post->save();
        // dd($allPost);
        // return response(1, 404);
        $title = 'Post List';
        $allPost = Post::withTrashed()->get();
        return view('clients/posts/list', compact('title', 'allPost'));
    }
    public function add()
    {
        $dataInsert = [
            'title' => 'Title 8',
            'content' => 'Content 8',
            'status' => 1
        ];
        $dataFind = ['id' => 4];
        $result = Post::firstOrCreate($dataFind, $dataInsert);
        return $result;
    }

    public function update($id)
    {
        $findData = ['status' => 0];
        $updateData = ['status' => 1];
        $post = Post::where($findData)->get();
        $post->updateOrCreate($findData, $updateData);
        dd($post);
    }
    public function delete($id)
    {
        // $post = Post::find($id);
        $post = Post::destroy([$id]);
        dd($post);
    }
    public function deleteAny(Request $request)
    {
        $deleteData = $request->delete;
        // $post = Post::find($id);
        $post = Post::destroy($deleteData);
        dd($post);
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->restore();
            return redirect()->route('post.index')->with(['msg' => 'Restore Successfully']);
        } else {
            return redirect()->route('post.index')->withErrors(['msg' => 'Post not found']);
        }
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->forceDelete();
            return redirect()->route('post.index')->with(['msg' => 'Delete Successfully']);
        } else {
            return redirect()->route('post.index')->withErrors(['msg' => 'Post not found']);
        }
    }
}
