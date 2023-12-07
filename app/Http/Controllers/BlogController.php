<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $url;

    public function __construct()
    {
        $this->url = env('BACK_END').'blogs';
        $this->middleware('guest')->except('logout');
    }
    public function index(Request $request){
        if(isset($request['page']) && $request['page']){
            $this->url = $request['page'];
        }
        $client = new Client();
        $api_response = $client->get($this->url, ['headers' => ['headers' =>['Accept ' => 'application/json']]]);
        $blogs = json_decode($api_response->getBody());
        return view('blogs.index',['blogs' => $blogs->data]);
    }

    public function show($id){
        $client = new Client();
        $api_response = $client->get($this->url.'/'.$id, ['headers' => ['headers' =>['Accept ' => 'application/json']]]);
        $blog = json_decode($api_response->getBody());
        return view('blogs.show',['blog' => $blog->data]);
    }

    public function create(Request $request){
        return view('blogs.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'      =>'required',
            'description'=>'required',
            'media'      =>'required',
        ]);
        $image_path =$request->media->getPathname();
        $image_mime = $request->media->getmimeType();
        $image_org  = $request->media->getClientOriginalName();
        $client = new Client();
        $header = ['Authorization' => 'Bearer ' . session('user_token')];
        $multipart = [
            [
                'name'     => 'title',
                'contents' => $request->title
            ],
            [
                'name'     => 'description',
                'contents' => $request->description
            ],
            [
                'name'     => 'media',
                'filename' => $image_org,
                'Mime-Type'=> $image_mime,
                'contents' => fopen( $image_path, 'r' )
            ]
        ];
        $client->post($this->url, [
            'headers' => $header,
            'multipart' => $multipart
        ]);
        return redirect()->route('blogs.index');
    }
}
