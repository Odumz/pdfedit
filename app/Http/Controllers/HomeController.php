<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pdf()
    {
        return view('PDF');
    }

    public function editPDF(Request $request)
    {
        $fullName = $request->fullName;
        $duration = $request->duration;
        $startDate = $request->startDate;

        $info = [
            'fullName' => $fullName,
            'duration' => $duration,
            'startDate' => $startDate,
        ];

        // dd($info);

        // Create new Landscape PDF
        $pdf = new Fpdi();

        // Reference the PDF you want to use (use relative path)
        $pagecount = $pdf->setSourceFile( 'Business_SLA(Services).pdf' );

        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();

        // Use the imported page as the template
        $pdf->useTemplate($tpl);

        // Set the default font to use
        $pdf->SetFont('Helvetica');

        // adding a Cell using:
        // $pdf->Cell( $width, $height, $text, $border, $fill, $align);

        // First box - the user's Name
        $pdf->SetFontSize('14'); // set font size
        $pdf->SetXY(65, 163); // set the position of the box
        $pdf->Cell(150, 5, $fullName, 0, 2, 'C'); // add the text, align to Center of cell

        // add the reason for certificate
        // note the reduction in font and different box position
        $pdf->SetFontSize('12');
        $pdf->SetXY(76, 172);
        $pdf->Cell(150, 10, $duration, 0, 0, 'C');

        // the day
        $pdf->SetFontSize('12');
        $pdf->SetXY(33,177);
        $pdf->Cell(5, 10, $startDate, 0, 0, 'L');
        // $pdf->Cell(5, 10, date('M'), 0, 0, 'L');
        // $pdf->Cell(9, 10, date('y'), 0, 0, 'R');

        // the month
        // $pdf->SetXY(160,122);
        // $pdf->Cell(30, 10, date('M'), 1, 0, 'C');

        // // the year, aligned to Left
        // $pdf->SetXY(200,122);
        // $pdf->Cell(20, 10, date('y'), 1, 0, 'L');

        // render PDF to browser
        $pdf->Output("", "I");
        // return view('NewPDF')->with('pdf',json_decode($pdf));
        return view('NewPDF', compact('pdf'));
    }
}
