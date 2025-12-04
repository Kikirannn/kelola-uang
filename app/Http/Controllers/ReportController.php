<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        $user = auth()->user();

        // Get summary
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->dateRange($startDate, $endDate)
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->dateRange($startDate, $endDate)
            ->sum('amount');

        // Get transactions by category
        $expenseByCategory = Transaction::where('transactions.user_id', $user->id)
            ->where('transactions.type', 'expense')
            ->dateRange($startDate, $endDate)
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select('categories.name', 'categories.color', DB::raw('SUM(transactions.amount) as total'))
            ->groupBy('categories.id', 'categories.name', 'categories.color')
            ->orderBy('total', 'desc')
            ->get();

        $incomeByCategory = Transaction::where('transactions.user_id', $user->id)
            ->where('transactions.type', 'income')
            ->dateRange($startDate, $endDate)
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select('categories.name', 'categories.color', DB::raw('SUM(transactions.amount) as total'))
            ->groupBy('categories.id', 'categories.name', 'categories.color')
            ->orderBy('total', 'desc')
            ->get();

        // Get daily transactions for line chart
        $dailyData = Transaction::where('user_id', $user->id)
            ->dateRange($startDate, $endDate)
            ->select(
                DB::raw('DATE(transaction_date) as date'),
                DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expense')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('reports.index', compact(
            'startDate',
            'endDate',
            'totalIncome',
            'totalExpense',
            'expenseByCategory',
            'incomeByCategory',
            'dailyData'
        ));
    }
}
