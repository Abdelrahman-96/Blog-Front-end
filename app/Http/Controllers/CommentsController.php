<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    protected $url;

    public function __construct()
    {
        $this->url = env('BACK_END').'comments';
        $this->middleware('guest')->except('logout');
    }
    public function delete($id){
        $client = new Client();
        $header = ['Authorization' => 'Bearer ' . session('user_token')];
        $client->delete($this->url.'/'.$id, ['headers' => $header]);
        return redirect()->back();
    }

    public function create(Request $request){
        $blog_id = $request->blog_id;
        return view('comments.create')->with(['blog_id' => $blog_id]);
    }
    public function store(Request $request){
        $client = new Client();
        $header = ['Authorization' => 'Bearer ' . session('user_token')];
        $api_response = $client->post($this->url, ['headers' => $header,'json' => [
                'name' => $request->name,
                'mail' => $request->mail,
                'url' =>  $request->url,
                'description' =>  $request->description,
                'blog_id' =>  $request->blog_id,

            ]]);
        json_decode($api_response->getBody());
        return redirect()->route('blogs.show', $request->blog_id);
    }

    public function edit(Request $request, $id){
        return view('comments.edit')->with(['id' => $id, 'mail' => $request->mail, 'name' => $request->name, 'url' => $request->url, 'description' => $request->description, 'blog_id' => $request->blog_id]);
    }

    public function update(Request $request, $id){
        $client = new Client();
        $header = ['Authorization' => 'Bearer ' . session('user_token')];
        $api_response = $client->post($this->url.'/'.$id, ['headers' => $header,'json' => [
                'name' => $request->name,
                'mail' => $request->mail,
                'url' =>  $request->url,
                'description' =>  $request->description,
            ]]);
        json_decode($api_response->getBody());
        return redirect()->route('blogs.show', $request->blog_id);
    }
}
