<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PageController extends Controller
{

    public function show($id)
    {
        return view('pages.page', [
            'page' => Page::findOrFail($id)
        ]);
    }

    public function index()
    {
        $pages = Page::all();
        return view('pages.index', ['pages' => $pages]);
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'title' => 'required|unique:pages|max:255',
            'description' => 'required'
        ]);

        $p = new Page;

        $p->title = $validated['title'];
        $p->description = $validated['description'];
        $p->save();

        session()->flash('message', 'Page Created');

        return redirect()->route('pages.index');
    }





}