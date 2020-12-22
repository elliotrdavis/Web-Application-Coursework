<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PageController extends Controller
{

    public function show($page)
    {
        //return view('pages.show', ['page' => $page]);
        return view('pages.show', ['page' => Page::findOrFail($page)]);
    }

    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
    		$view = view('data',compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }

    	return view('pages.index',compact('posts'));
    }

    public function apiIndex()
    {
        $pages = Page::all();
        return $pages;
    }

}