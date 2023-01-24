<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use DB;

class AdminController extends Controller
{

    public function total()
    {
        $total = Pengaduan::select(DB::raw("COUNT(*) as count"))
            ->whereYear("created_at", date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        return view('admin.dashboard', compact('total'));
    }

}
