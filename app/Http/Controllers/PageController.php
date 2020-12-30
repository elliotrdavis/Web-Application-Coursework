<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PageController extends Controller
{

    public function show($page, Request $request)
    {
        $posts = Post::where('page_id', $page)->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
    		$view = view('data',compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }

    	return view('pages.home',compact('posts'));
    }

    public function home(Request $request)
    {

        $posts = Post::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if(($term = $request->term)) {
                    $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
    		$view = view('data',compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('pages.home',compact('posts'));
    }

    public function apiIndex()
    {
        $pages = Page::all();
        return $pages;
    }

}