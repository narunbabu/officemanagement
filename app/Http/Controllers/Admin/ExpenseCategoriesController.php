<?php

namespace App\Http\Controllers\Admin;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExpenseCategories;
use App\Http\Requests\Admin\UpdateExpenseCategories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use DB;
// use App\Http\Controllers\Admin\ExpenseCategoriesController;
class ExpenseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if($request->session()->has('currentUser')){
    	// 	$expense_categories = DB::table('expense_categories')->get(); //here i take example table for result purpose
           // return view('admin.expense_categories.index');
            //  ['expense_categories' => $expense_categories]);
        // }
        // else{
        //     return view('errors/unauthorized');
        // }
//this code copy from the office_expenses controllers...
        // if (! Gate::allows('expense_category_access')) {
        //     return abort(401);
        // }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('ExpenseCategory.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('ExpenseCategory.filter', 'my');
            }
        }

                $expense_categories = ExpenseCategory::all();

        return view('admin.expense_categories.index', compact('expense_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if (! Gate::allows('expense_category_create')) {
        //     return abort(401);
        // }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('please_select'), '');

        return view('admin.expense_categories.create', compact('created_bies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\StoreExpenseCategories  $request
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseCategories $request)
    {
        // if (! Gate::allows('expense_category_create')) {
        //     return abort(401);
        // }
        $expense_category = ExpenseCategory::create($request->all());

        return redirect()->route('expense_categories.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpensesCategories  $expensesCategories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (! Gate::allows('expense_category_view')) {
        //     return abort(401);
        // }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$expenses = \App\Expense::where('expense_category_id', $id)->get();

        $expense_category = ExpenseCategory::findOrFail($id);

        return view('admin.expense_categories.show', compact('expense_category', 'expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpensesCategories  $expensesCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('expense_category_edit')) {
        //     return abort(401);
        // }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $expense_category = ExpenseCategory::findOrFail($id);

        return view('admin.expense_categories.edit', compact('expense_category', 'created_bies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpensesCategories  $expensesCategories
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseCategoriesRequest $request, $id)
    {
        // if (! Gate::allows('expense_category_edit')) {
        //     return abort(401);
        // }
        $expense_category = ExpenseCategory::findOrFail($id);
        $expense_category->update($request->all());



        return redirect()->route('admin.expense_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpensesCategories  $expensesCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (! Gate::allows('expense_category_delete')) {
        //     return abort(401);
        // }
        $expense_category = ExpenseCategory::findOrFail($id);
        $expense_category->delete();

        return redirect()->route('admin.expense_categories.index');
    }
}
