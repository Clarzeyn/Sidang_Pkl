<?php

namespace App\Http\Controllers;

use App\Pengaduan;

class Admin1Controller extends Controller
{
    public function total()
    {
        $totalPengaduan = Pengaduan::count();
        return view('admin.dashboard', compact('totalPengaduan'));
    }
}
