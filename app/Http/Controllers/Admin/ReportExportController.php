<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TurnsReportExport;
use App\Http\Controllers\Controller;
use App\Models\Turn;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportExportController extends Controller
{
    public function dates()
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $dates = Turn::selectRaw('DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date');

        return response()->json($dates);
    }

    public function export(Request $request)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $date = $request->query('date');

        if ($date && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            abort(400, 'Formato de fecha inválido.');
        }

        $suffix = $date ? \Carbon\Carbon::parse($date)->format('d-m-Y') : now()->format('d-m-Y');
        $filename = 'reporte_' . $suffix . '.xlsx';

        return Excel::download(new TurnsReportExport($date), $filename);
    }
}
