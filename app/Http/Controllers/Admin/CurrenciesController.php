<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCurrencies;
use App\Http\Requests\Admin\UpdateCurrencies;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('currency_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Currency.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Currency.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('currency_delete')) {
                return abort(401);
            }
            $currencies = Currency::onlyTrashed()->get();
        } else {
            $currencies = Currency::all();
        }

        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('currency_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('please_select'), '');

        return view('admin.currencies.create', compact('created_bies'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\StoreCurrencies  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrencies $request)
    {
        if (! Gate::allows('currency_create')) {
            return abort(401);
        }
        $currency = Currency::create($request->all());



        return redirect()->route('admin.currencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('currency_view')) {
            return abort(401);
        }
        $currency = Currency::findOrFail($id);

        return view('admin.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('currency_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $currency = Currency::findOrFail($id);

        return view('admin.currencies.edit', compact('currency', 'created_bies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrencies $request, $id)
    {
        if (! Gate::allows('currency_edit')) {
            return abort(401);
        }
        $currency = Currency::findOrFail($id);
        $currency->update($request->all());



        return redirect()->route('admin.currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('currency_delete')) {
            return abort(401);
        }
        $currency = Currency::findOrFail($id);
        $currency->delete();

        return redirect()->route('admin.currencies.index');
    }
}
