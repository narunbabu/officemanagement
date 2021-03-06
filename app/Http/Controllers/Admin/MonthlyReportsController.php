<?php

namespace App\Http\Controllers\Admin;

use App\Income;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonthlyReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $from    = Carbon::parse(sprintf(
            '%s-%s-01',
            $r->query('y', Carbon::now()->year),
            $r->query('m', Carbon::now()->month)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;

        $exp_q = Expense::with('expense_category')
            ->whereBetween('entry_date', [$from, $to]);

        $inc_q = Income::with('income_category')
            ->whereBetween('entry_date', [$from, $to]);

        $exp_total = $exp_q->sum('amount');
        $inc_total = $inc_q->sum('amount');
        $exp_group = $exp_q->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
        $inc_group = $inc_q->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
        $profit    = $inc_total - $exp_total;

        $exp_summary = [];
        foreach ($exp_group as $exp) {
            foreach ($exp as $line) {
                if (! isset($exp_summary[$line->expense_category->name])) {
                    $exp_summary[$line->expense_category->name] = [
                        'name'   => $line->expense_category->name,
                        'amount' => 0,
                    ];
                }
                $exp_summary[$line->expense_category->name]['amount'] += $line->amount;
            }
        }

        $inc_summary = [];
        foreach ($inc_group as $inc) {
            foreach ($inc as $line) {
                if (! isset($inc_summary[$line->income_category->name])) {
                    $inc_summary[$line->income_category->name] = [
                        'name'   => $line->income_category->name,
                        'amount' => 0,
                    ];
                }
                $inc_summary[$line->income_category->name]['amount'] += $line->amount;
            }
        }

        return view('admin.monthly_reports.index', compact(
            'exp_summary',
            'inc_summary',
            'exp_total',
            'inc_total',
            'profit'
        ));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MonthlyReports  $monthlyReports
     * @return \Illuminate\Http\Response
     */
    public function show(MonthlyReports $monthlyReports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MonthlyReports  $monthlyReports
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthlyReports $monthlyReports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MonthlyReports  $monthlyReports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthlyReports $monthlyReports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MonthlyReports  $monthlyReports
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyReports $monthlyReports)
    {
        //
    }
}
