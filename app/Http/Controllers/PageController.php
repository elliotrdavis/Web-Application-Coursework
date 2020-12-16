<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PageController extends Controller
{

    public function show($page)
    {
        //return view('pages.show', ['page' => $page]);
        return view('pages.show', ['page' => Page::findOrFail($page)]);
    }

    public function index()
    {
        return view('pages.index', ['pages' => Page::all()]);
    }

    public function store(Request $request) 
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $p = new Page;

        $p->title = $validatedData['title'];
        $p->description = $validatedData['description'];
        $p->save();

        session()->flash('message', 'Page Created');

        return redirect()->route('pages.index');
    }





}