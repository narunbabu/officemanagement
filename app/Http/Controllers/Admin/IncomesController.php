<?php

namespace App\Http\Controllers\Admin;

use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomes;
use App\Http\Requests\Admin\UpdateIncomes;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('income_access')) {
        //     return abort(401);
        // }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Income.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Income.filter', 'my');
            }
        }

                $incomes = Income::all();

        return view('admin.incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('income_create')) {
        //     return abort(401);
        // }
        
        $income_categories = \App\IncomeCategory::get()->pluck('name', 'id')->prepend(trans('please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('please_select'), '');

        return view('admin.incomes.create', compact('income_categories', 'created_bies'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     *@param  \App\Http\Requests\StoreIncomes  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomes $request)
    {
        // if (! Gate::allows('income_create')) {
        //     return abort(401);
        // }
        $income = Income::create($request->all());  //+ ['currency_id' => Auth::user()->currency_id]);

        return redirect()->route('admin.incomes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incomes  $incomes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('income_view')) {
            return abort(401);
        }
        $income = Income::findOrFail($id);

        return view('admin.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incomes  $incomes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('income_edit')) {
            return abort(401);
        }
        
        $income_categories = \App\IncomeCategory::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $income = Income::findOrFail($id);

        return view('admin.incomes.edit', compact('income', 'income_categories', 'created_bies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incomes  $incomes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomesRequest $request, $id)
    {
        if (! Gate::allows('income_edit')) {
            return abort(401);
        }
        $income = Income::findOrFail($id);
        $income->update($request->all());

        return redirect()->route('admin.incomes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incomes  $incomes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('income_delete')) {
            return abort(401);
        }
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('admin.incomes.index');
    }
}
