<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        $notifs = Auth::user()->unreadNotifications;
        return view('layouts.web.category.index')->with('categories', $categories)->with('notifs', $notifs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = Auth::user()->unreadNotifications;
        return view('layouts.web.category.create')->with('notifs', $notifs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->subcategory_type != null) {
            $find = Category::where('category_type', $request->category_type)->where('subcategory_type', $request->subcategory_type)->first();
        } else {
            $find = Category::where('category_type', $request->category_type)->first();
        }
        $valid = true;

        if ($find != null) {
            switch($lower = Str::lower($request->category_type))
            {
                case 'bemo':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                case 'bajaj':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                case 'bentor':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                case 'becak':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                case 'ojek':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                default:
                    $valid = false;
                    flash('Sorry, the category and subcategory already exist')->error()->important();
            }
        } else { // for find kosong
            if ($request->subcategory_type != null) {
                switch($lower = Str::lower($request->category_type))
                {
                    case 'bemo':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        return redirect()->back();
                        break;
                    case 'bajaj':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        return redirect()->back();
                        break;
                    case 'bentor':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        return redirect()->back();
                        break;
                    case 'becak':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        return redirect()->back();
                        break;
                    case 'ojek':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        return redirect()->back();
                        break;
                    default:
                    if ($valid == true) {
                        $data = $request->all();
                    }
                }
            } else {
                switch($lower = Str::lower($request->category_type))
                {
                    case 'bemo':
                        $data = $request->all();
                        break;
                    case 'bajaj':
                        $data = $request->all();
                        break;
                    case 'bentor':
                        $data = $request->all();
                        break;
                    case 'becak':
                        $data = $request->all();
                        break;
                    case 'ojek':
                        $data = $request->all();
                        break;
                    default:
                        flash('Sorry, the subcategory can\'t empty')->error()->important();
                        $valid = false;
                        return redirect()->back();
                }

            }
        }

        if ($request->subcategory_type == null ) {
            $validator = Validator::make($request->all(), [
                'category_type' => 'required|regex:/^[a-zA-Z ]+$/',
            ]);            
        } else {
            $validator = Validator::make($request->all(), [
                'category_type' => 'required|regex:/^[a-zA-Z ]+$/',
                'subcategory_type' => 'regex:/^[a-zA-Z ]+$/',
            ]);
        }

        if ($validator->fails()) {
            $valid = false;
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        Category::create($data);            

        flash('Your data category created successfully')->success()->important();
        return redirect()->route('create-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $findById = Category::findOrFail($id);
        if($request->subcategory_type != null) {
            $find = Category::where('category_type', $request->category_type)->where('subcategory_type', $request->subcategory_type)->first();
        } else {
            $find = Category::where('category_type', $request->category_type)->first();
        }
        if ($find != null) {
            $findCatSub = $find->id;
        }
        $findCatSub = null;

        $valid = true;
        if ($findCatSub != $id) {
            switch($lower = Str::lower($request->category_type))
            {
                case 'bemo':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                case 'bajaj':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                case 'bentor':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    break;
                case 'becak':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                case 'ojek':
                    flash('Sorry, the category '.$lower.' already exist, it\'s only allow for one data')->error()->important();
                    $valid = false;
                    return redirect()->back();
                    break;
                default:
                    if ($findCatSub != null) {
                        $valid = false;
                        flash('Sorry, the category and subcategory already exist')->error()->important();
                        return redirect()->back();
                    }
            }
        } else { // klo category yg d cari == id yg d inputin
            if ($request->subcategory_type != null) {
                switch($lower = Str::lower($request->category_type))
                {
                    case 'bemo':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        break;
                    case 'bajaj':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        break;
                    case 'bentor':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        break;
                    case 'becak':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        break;
                    case 'ojek':
                        flash('Sorry, the subcategory should be empty')->error()->important();
                        $valid = false;
                        break;
                    default:
                    if ($valid == true) {
                        $data = $request->all();
                    }
                }
            } else {
                switch($lower = Str::lower($request->category_type))
                {
                    case 'bemo':
                        break;
                    case 'bajaj':
                        break;
                    case 'bentor':
                        break;
                    case 'becak':
                        break;
                    case 'ojek':
                        break;
                    default:
                        flash('Sorry, the subcategory can\'t empty')->error()->important();
                        $valid = false;
                        return redirect()->back();
                }

            }
        }

        if ($request->subcategory_type == null ) {
            $validator = Validator::make($request->all(), [
                'category_type' => 'required|regex:/^[a-zA-Z ]+$/',
            ]);            
        } else {
            $validator = Validator::make($request->all(), [
                'category_type' => 'required|regex:/^[a-zA-Z ]+$/',
                'subcategory_type' => 'regex:/^[a-zA-Z ]+$/',
            ]);
        }

        if ($validator->fails()) {
            $valid = false;           
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($valid == true) {
            if ($request->subcategory_type == null ) {
                $findById['category_type'] = $request['category_type'];
                $findById->save();            
            } else {
                $findById['category_type'] = $request['category_type'];
                $findById['subcategory_type'] = $request['subcategory_type'];
                $findById->save();            
            }
        }

        flash('Success updated your category')->success()->important();
        return redirect()->route('view-categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // When delete category, we need to delete the category_id from service, favorite first
        $categories = Category::findOrFail($id);
        $services = Service::where('category_id', $id)->get();
        $favorites = Favorite::where('category_id', $id)->get();

        if ($favorites != null) {
            foreach ($favorites as $favorite) {
                $favorite['category_id'] = 0;
                $favorite->save();
            }            
        }

        if ($services != null) {
            foreach ($services as $service) {
                $service['category_id'] = 0;
                $service->save();
            }
        }

        $categories->delete();
        flash('The category success deleted')->success()->important();
        return redirect()->back();
    }
}
