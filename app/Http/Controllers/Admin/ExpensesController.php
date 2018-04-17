<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExpenses;
use App\Http\Requests\Admin\UpdateExpenses;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('expense_access')) {
        //     return abort(401);
        // }
        $expenses = Expense::all();

        return view('admin.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('expense_create')) {
        //     return abort(401);
        // }
        
        $expense_categories = \App\ExpenseCategory::get()->pluck('name', 'id')->prepend(trans('please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('please_select'), '');

        return view('admin.expenses.create', compact('expense_categories', 'created_bies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenses $request)
    {
        // if (! Gate::allows('expense_create')) {
        //     return abort(401);
        // }
        $expense = Expense::create($request->all() + ['currency_id' => Auth::user()->currency_id]);



        return redirect()->route('expenses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('expense_view')) {
            return abort(401);
        }
        $expense = Expense::findOrFail($id);

        return view('admin.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('expense_edit')) {
            return abort(401);
        }
        
        $expense_categories = \App\ExpenseCategory::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $expense = Expense::findOrFail($id);

        return view('admin.expenses.edit', compact('expense', 'expense_categories', 'created_bies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesRequest $request, $id)
    {
        if (! Gate::allows('expense_edit')) {
            return abort(401);
        }
        $expense = Expense::findOrFail($id);
        $expense->update($request->all());



        return redirect()->route('admin.expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('expense_delete')) {
            return abort(401);
        }
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('admin.expenses.index');
    }
}
