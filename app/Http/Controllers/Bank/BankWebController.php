<?php

namespace App\Http\Controllers\Bank;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BankWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::orderBy('id', 'desc')->paginate(10);
        return view('layouts.web.bank.index')->with('banks', $banks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.web.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'bank_name' => 'required|regex:/[a-zA-Z]/',
                'bank_account' => 'required|regex:/[0-9]/',
                'bank_image' => 'required|image',
                'transfer_description' => 'string',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['bank_image'] = $request->bank_image->store('');
        $data['admin_created'] = auth()->user()->id;
        $data['admin_updated'] = auth()->user()->id;
        
        $bank = Bank::create($data);
        flash('Success create new bank account')->success()->important();
        return redirect()->route('view-index-bank');
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
        $bank = Bank::findOrFail($id);
        return view('layouts.web.bank.edit')->with('bank', $bank);
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
        $bank = Bank::findOrFail($id);

        $validator = Validator::make($request->all(), [
                'bank_name' => 'required|regex:/[a-zA-Z]/',
                'bank_account' => 'required|regex:/[0-9]/',
                'bank_image' => 'required|image',
                'transfer_description' => 'string',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('bank_image')) {
            Storage::delete($bank['bank_image']);
            $bank['bank_image'] = $request->bank_image->store('');
        }
        $bank['bank_name'] = $request->bank_name;
        $bank['bank_account'] = $request->bank_account;
        $bank['admin_updated'] = auth()->user()->id;
        if($request->has('transfer_description')) {
            $bank['transfer_description'] = $request->transfer_description;
        }

        $bank->save();
        flash('Success update bank account')->success()->important();

        return redirect()->route('view-index-bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank['admin_updated'] = auth()->user()->id;
        $bank->save();
        $bank->delete();
        flash('Success delete bank account')->success()->important();

        return redirect()->route('view-index-bank');
    }
}
