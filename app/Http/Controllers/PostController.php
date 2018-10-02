<?php namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard',['posts' => $posts]); 
    }   

    public function postCreatePost(Request $request)
    {
        $this->validate($request,[
            'body' => 'required|max:1000'
        ]);

        $post = new Post();
        $post->body = $request['body'];

        $message = 'Ops! Algo deu errado!';

        if($request->user()->posts()->save($post)){
            $message = 'Seu post foi publicado!';
        };
        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->route('dashboard')->with(['error' => 'Você não pode deletar este post']);
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Post Deletado!']);
    }

    public function postEditPost(Request $request)
    {
        $request->validate([
            'postData' => 'required',
            'postId' => 'required'
        ]);
        
        $post = Post::find($request->input('postId'));

        if(Auth::user() != $post->user){
            return redirect()->route('dashboard')->with(['error' => 'Você não pode editar este post']);
        }

        $post->body = $request->input('postData');
        $post->update();
        return response()->json(['post'=>$post], 200);
    }

}