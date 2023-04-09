<?php

namespace App\Http\Controllers;

use App\Models\Conger;
use App\Models\Pdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Elibyy\TCPDF\Facades\TCPDF;

class  PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $pddf = Pdf::where('id', $id)->first();
        //$pddf = Conger::where('id', $id)->first();
        //dd($pddf->personne->nomAr);
        $html = view('Pdf.pdf', [
            "pdf" => $pddf,
        ]);

        $pdf = new TCPDF;
        $pdf::setPrintHeader(true);
        $pdf::SetHeaderData(public_path('picture/abhbcLogo.jpg'), 100, 50, ' 009', 'PDF_HEADER_STRING');
        $pdf::setRTL(true);
        $pdf::SetFont('aealarabiya', '', 12);
        $pdf::SetTitle('Conger');
        $pdf::AddPage('P', [290, 400]);
        $pdf::Image(public_path('images/abhbcLogo.jpg'), 0, 0, 50, 50, 'JPG');
        $pdf::Image(public_path('images/royal.jpg'), 265, 0, 18, 18, 'JPG');
        $pdf::writeHTML($html, true, false, true, false, '');

        /////////////////////////////////////////////////////////

        $pdf::AddPage('P', [290, 400]);
        $html2 = view('Pdf.adPdf', [
            "pdf" => $pddf,
        ]);
        $pdf::Image(public_path('images/abhbcLogo.jpg'), 0, 0, 50, 50, 'JPG');
        $pdf::Image(public_path('images/royal.jpg'), 265, 0, 18, 18, 'JPG');
        $pdf::writeHTML($html2, true, false, true, false, '');
        $name = $pddf->personne->nom;
        $pdf::Output('conge_' . $name . '.pdf', 'D');
    }
}
