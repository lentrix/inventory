<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index() {
        $offices = Office::orderBy('name')->with('user')->get();
        $users = User::orderBy('fullname')->get();

        return inertia('offices/Index',[
            'offices' => $offices,
            'users' => $users
        ]);
    }


    public function store(Request $request) {
        $fields = $request->validate([
            'name'=>'required',
            'building'=>'required',
            'user_id'=>'numeric|required',
        ]);

        Office::create($fields);

        return redirect('/offices');
    }


    public function update(Request $request, Office $office) {
        $fields = $request->validate([
            'name'=>'required',
            'building'=>'required',
            'user_id'=>'numeric|required',
        ]);

        $office->update($fields);

        return redirect('/offices');
    }

    public function destroy(Office $office) {
        if( ($c = $office->items->count()) > 0 ) {
            return back()->withErrors(['GeneralErrors'=>"You cannot delete the office $office->name because it has $c items."]);
        }

        $office->delete();

        return back();
    }
}
