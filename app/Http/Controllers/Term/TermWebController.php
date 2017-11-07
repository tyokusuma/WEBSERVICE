<?php

namespace App\Http\Controllers\Term;

use App\Http\Controllers\Controller;
use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermWebController extends Controller
{
    public function index()
    {
        $terms = Term::orderBy('id', 'desc')->paginate(10);
        return view('layouts.web.term.index')->with('terms', $terms);
    }

    public function create() 
    {
        return view('layouts.web.term.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_term' => 'required|string',
            'category_content' => 'required|string',
            'content' => 'required|string',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['admin_created'] = auth()->user()->id;
        $data['admin_updated'] = auth()->user()->id;
        $term = Term::create($data);
        flash('Term created successfully')->success()->important();
        return redirect()->route('view-index-term');
    }

    public function edit($id) 
    {
        $term = Term::findOrFail($id); 
        return view('layouts.web.term.edit')->with('term', $term);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'type_term' => 'required|string',
                'category_content' => 'required|string',
                'content' => 'required|string',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $term = Term::findOrFail($id);
        $term['type_term'] = $request->type_term;
        $term['category_content'] = $request->category_content;
        $term['content'] = $request->content;
        $term->save();

        flash('Term created successfully')->success()->important();
        return redirect()->route('view-index-term');
    }

    public function destroy($id)
    {
        $term = Term::findOrFail($id);
        $term->delete();

        flash('Term created successfully')->success()->important();
        return redirect()->route('view-index-term');
    }

    public function preview($id)
    {
        $term = Term::findOrFail($id);
        return view('layouts.web.term.preview')->with('term', $term);
    }

    public function terms() 
    {
        $terms = Term::all();
        return view('layouts.web.privacynterm.terms')->with('terms', $terms);
    }
}
