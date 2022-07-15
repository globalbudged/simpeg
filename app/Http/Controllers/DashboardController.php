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
        $collection = collect(Pegawai::all());
        $flag = $collection->pluck('flag');
        $counted = $flag->countBy();

        return response()->json($counted);
    }
    public function logs_all()
    {
        // $logs = AuditLog::take(10)->latest()->get();
        $logs = AuditLogCollection::collection(AuditLog::take(10)->latest()->get());

        return response()->json($logs);
    }
}
