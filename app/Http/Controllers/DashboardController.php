<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuditLogCollection;
use App\Models\AuditLog;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $collection = collect(Pegawai::with('jenis')->get());
        $all_active = $collection->filter(function ($item) {
            return $item->flag > 0;
        })->count();
        $honorer = $collection->filter(function ($item) {
            return $item->jenis->id === 3;
        })->count();
        // $flag = $collection->pluck('flag');
        // $counted = $flag->countBy();
        $data = [
            'total_all' => $collection->count(),
            'total_active' => $all_active,
            'total_keluar' => $collection->count() - $all_active,
            'honorer' => $honorer,
            'asn' => $all_active - $honorer
        ];

        return response()->json($data);
    }
    public function logs_all()
    {
        // $logs = AuditLog::take(10)->latest()->get();
        $logs = AuditLogCollection::collection(AuditLog::take(10)->latest()->get());

        return response()->json($logs);
    }
}
