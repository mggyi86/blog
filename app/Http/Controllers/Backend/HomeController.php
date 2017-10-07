<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\AccountUpdateRequest;

class HomeController extends BackendController
{

    public function index()
    {
        return view('backend.home.index');
    }

    public function edit(Request $request)
    {
    	$user = $request->user();
    	return view("backend.home.edit", compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
    	$user = $request->user();
    	$user->update($request->all());

    	return redirect()->back()->with("message", "Account was updated successfully!");
    }
}
