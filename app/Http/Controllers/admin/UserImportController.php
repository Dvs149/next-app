<?php

namespace App\Http\Controllers\admin;

use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\admin\eport\UsersExport;
use App\Imports\admin\import\UsersImport;


class UserImportController extends Controller
{

    public function user_import(Request $request) 
    {
        // dd($request->all());
        Excel::import(new UsersImport, $request->file('imp_excel')->store('temp'));
        return back()->with('message', 'All User added from Excel sheet!');
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }
}
