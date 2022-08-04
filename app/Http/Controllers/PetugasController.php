<?php

namespace App\Http\Controllers;

use App\Komentar;
use App\Pengaduan;
use App\Pengaduans;
use App\Pengumuman;
use App\User;

class PetugasController extends Controller
{

    public function total()
    {
        $totalPengaduan = Pengaduan::count();
        $admin = User::where('level', 'admin');
        $admin = $admin->count();
        $petugas = User::where('level', 'petugas');
        $petugas = $petugas->count();
        $masyarakat = User::where('level', 'masyarakat');
        $masyarakat = $masyarakat->count();
        $totalUser = User::count();
        $selesai = Pengaduans::where('status', 'selesai');
        $selesai = $selesai->count();
        $proses = Pengaduans::where('status', 'proses');
        $proses = $proses->count();
        $verified = Pengaduans::where('status', 'verified');
        $verified = $verified->count();

        $pengaduan = Pengaduan::where('Foto');
        $pengaduan = Pengaduan::count();
        $komentar = Komentar::count();
        $pengumuman = Pengumuman::count();

        return view('petugas.dashboard', compact('totalPengaduan', 'totalUser', 'selesai', 'pengaduan', 'admin', 'petugas',
            'masyarakat', 'proses', 'verified', 'komentar', 'pengumuman'));
    }

}
