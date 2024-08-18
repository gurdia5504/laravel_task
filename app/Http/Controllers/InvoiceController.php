<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function getInvoicesByCurrency()
    {
        $invoices = DB::table('invoices')
            ->select('currency', 'invoice_number', 'amount', 'invoice_date')
            ->get();

        $groupedInvoices = $invoices->groupBy('currency')->map(function ($currencyInvoices) {
            return [
                'today' => $this->filterInvoicesByDate($currencyInvoices, 'today'),
                'yesterday' => $this->filterInvoicesByDate($currencyInvoices, 'yesterday'),
                'this_week' => $this->filterInvoicesByDate($currencyInvoices, 'this_week'),
                'last_week' => $this->filterInvoicesByDate($currencyInvoices, 'last_week'),
                'this_month' => $this->filterInvoicesByDate($currencyInvoices, 'this_month'),
                'last_month' => $this->filterInvoicesByDate($currencyInvoices, 'last_month'),
                'this_year' => $this->filterInvoicesByDate($currencyInvoices, 'this_year'),
                'last_year' => $this->filterInvoicesByDate($currencyInvoices, 'last_year'),
            ];
        });

        return response()->json($groupedInvoices);
    }

    private function filterInvoicesByDate($invoices, $period)
    {
        $now = Carbon::now();

        switch ($period) {
            case 'today':
                return $invoices->where('invoice_date', $now->toDateString())->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            case 'yesterday':
                return $invoices->where('invoice_date', $now->subDay()->toDateString())->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            case 'this_week':
                return $invoices->whereBetween('invoice_date', [$now->startOfWeek()->toDateString(), $now->endOfWeek()->toDateString()])->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            case 'last_week':
                return $invoices->whereBetween('invoice_date', [$now->subWeek()->startOfWeek()->toDateString(), $now->subWeek()->endOfWeek()->toDateString()])->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            case 'this_month':
                return $invoices->whereBetween('invoice_date', [$now->startOfMonth()->toDateString(), $now->endOfMonth()->toDateString()])->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            case 'last_month':
                return $invoices->whereBetween('invoice_date', [$now->subMonth()->startOfMonth()->toDateString(), $now->subMonth()->endOfMonth()->toDateString()])->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            case 'this_year':
                return $invoices->whereBetween('invoice_date', [$now->startOfYear()->toDateString(), $now->endOfYear()->toDateString()])->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            case 'last_year':
                return $invoices->whereBetween('invoice_date', [$now->subYear()->startOfYear()->toDateString(), $now->subYear()->endOfYear()->toDateString()])->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                    ];
                })->values();
            default:
                return [];
        }
    }
}
