<?php

namespace App\Http\Controllers\Admin;

use App\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomeCategories;
use App\Http\Requests\Admin\UpdateIncomeCategories;

class IncomeCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('income_category_access')) {
        //     return abort(401);
        // }
        
        $income_categories = IncomeCategory::all();

        return view('admin.income_categories.index', compact('income_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('income_category_create')) {
        //     return abort(401);
        // }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.income_categories.create', compact('created_bies'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\StoreIncomeCategories  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomeCategories $request)
    {
        // if (! Gate::allows('income_category_create')) {
        //     return abort(401);
        // }
        $income_category = IncomeCategory::create($request->all());

        return redirect()->route('income_categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IncomeCategories  $incomeCategories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (! Gate::allows('income_category_view')) {
        //     return abort(401);
        // }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('please_select'), '');$incomes = \App\Income::where('income_category_id', $id)->get();

        $income_category = IncomeCategory::findOrFail($id);

        return view('admin.income_categories.show', compact('income_category', 'incomes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IncomeCategories  $incomeCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('income_category_edit')) {
        //     return abort(401);
        // }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $income_category = IncomeCategory::findOrFail($id);

        return view('admin.income_categories.edit', compact('income_category', 'created_bies'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdateIncomeCategories  $request
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IncomeCategories  $incomeCategories
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomeCategories $request, $id)
    {
        // if (! Gate::allows('income_category_edit')) {
        //     return abort(401);
        // }
        $income_category = IncomeCategory::findOrFail($id);
        $income_category->update($request->all());

        return redirect()->route('admin.income_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IncomeCategories  $incomeCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (! Gate::allows('income_category_delete')) {
        //     return abort(401);
        // }
        $income_category = IncomeCategory::findOrFail($id);
        $income_category->delete();

        return redirect()->route('admin.income_categories.index');
    }
}
