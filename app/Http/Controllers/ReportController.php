<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function article()
    {
        return view('admin.pengaduan.index');
    }

    public function reportArticle(Request $request)
    {
        $start = $request->tanggalAwal;
        $end = $request->tanggalAkhir;
        if ($start > $end) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Maaf tanggal yang anda masukan tidak sesuai",
            ]);
            return back();

        } else {
            $tanggapan = Tanggapan::whereBetween('created_at', [$start, $end])
                ->get();
            $total = Tanggapan::select('user_id', DB::raw('sum(user_id) as total_pengguna'))->groupBy('user_id')->first();
            // dd($total);
            // dd($article);
            // $pdf = \PDF::loadView('admin.report.article_report', ['article' => $article]);
            // return $pdf->download('article-report.pdf');
            return view('admin.report.article_report', ['article' => $article, 'total_pengguna' => $total, 'start' => $start, 'end' => $end]);
        }

    }

    public function printReport(Request $request)
    {
        $start = $request->tanggalAwal;
        $end = $request->tanggalAkhir;
        if ($start > $end) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Maaf tanggal yang anda masukan tidak sesuai",
            ]);
            return back();

        } else {
            $article = Article::whereBetween('created_at', [$start, $end])
                ->get();
            $total = Article::select('user_id', DB::raw('sum(user_id) as total_pengguna'))->groupBy('user_id')->first();
            $pdf = \PDF::loadView('admin.report.print-report', ['article' => $article, 'total_pengguna' => $total]);
            return $pdf->download('print-report.pdf');
            // return view('admin.report.article_report', ['article' => $article, 'total_pengguna' => $total]);
        }
    }

    // excel
    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
