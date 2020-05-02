<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function s3show()
    {
        return view('S3test');
    }

    public function editPDF(Request $request)
    {
        $fullName = $request->fullName;
        $duration = $request->duration;
        $startDate = $request->startDate;
        $scope = $request->scope;
        $binding = $request->binding;
        $durationFrom = $request->durationFrom;
        $durationTo = $request->durationTo;
        $cost = $request->cost;
        $per = $request->per;
        $total = $request->total;
        $paymentDue = $request->paymentDue;
        $paymentTo = $request->paymentTo;
        $availabilityTime = $request->availabilityTime;
        $approvalDate = $request->approvalDate;
        $clientName = $request->clientName;

        $info = [
            'fullName' => $fullName,
            'duration' => $duration,
            'startDate' => $startDate,
            'scope' => $scope,
            'binding' => $binding,
            'durationFrom' => $durationFrom,
            'durationTo' => $durationTo,
            'cost' => $cost,
            'per' => $per,
            'total' => $total,
            'paymentDue' => $paymentDue,
            'paymentTo' => $paymentTo,
            'availabilityTime' => $availabilityTime,
            'approvalDate' => $approvalDate,
            'clientName' => $clientName,

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
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(65, 163); // set the position of the box
        $pdf->Cell(150, 5, $fullName, 0, 2, 'C'); // add the text, align to Center of cell

        // add the reason for certificate
        // note the reduction in font and different box position
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(76, 172);
        $pdf->Cell(150, 10, $duration, 0, 0, 'C');

        // the day
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(33,177);
        $pdf->Cell(5, 10, $startDate, 0, 0, 'L');

        // PAGE TWO
        // // note the reduction in font and different box position

        $tpl = $pdf->importPage(2);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(40, 78);
        $pdf->Cell(10, 5, $scope, 0, 0, 'C');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(112, 78);
        $pdf->Cell(10, 5, $binding, 0, 0, 'C');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(163,84);
        $pdf->Cell(5, 5, $durationFrom, 0, 0, 'L');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(43,90);
        $pdf->Cell(5, 5, $durationTo, 0, 0, 'L');


        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(90,112);
        $pdf->Cell(5, 5, $cost, 0, 0, 'L');


        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(132,112);
        $pdf->Cell(5, 5, $per, 0, 0, 'L');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(166,112);
        $pdf->Cell(5, 5, $total, 0, 0, 'L');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(154,171);
        $pdf->Cell(5, 5, $paymentDue, 0, 0, 'L');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(56,182);
        $pdf->Cell(5, 5, $paymentTo, 0, 0, 'L');

        //PAGE THREE

        $tpl = $pdf->importPage(3);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(37,86);
        $pdf->Cell(5, 5, $availabilityTime, 0, 0, 'L');



        //PAGE FOUR

        $tpl = $pdf->importPage(4);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(148,105);
        $pdf->Cell(5, 5, $approvalDate, 0, 0, 'L');

        $pdf->SetFontSize('12');
        $pdf->SetTextColor(96,96,96);
        $pdf->SetXY(148,118);
        $pdf->Cell(5, 5, $approvalDate, 0, 0, 'L');
        // $pdf->Cell(5, 10, date('M'), 0, 0, 'L');
        // $pdf->Cell(9, 10, date('y'), 0, 0, 'R');

        // the month
        // $pdf->SetXY(160,122);
        // $pdf->Cell(30, 10, date('M'), 1, 0, 'C');

        // // the year, aligned to Left
        // $pdf->SetXY(200,122);
        // $pdf->Cell(20, 10, date('y'), 1, 0, 'L');

        // dd(gettype($pdf));
        // render PDF to browser

        $filename=$clientName.'_Cerebro_Business_SLA(Services).pdf';

        $pdf->Output($filename, "I");

        $newpdf = $pdf->Output("/var/www/html/pdf-edit/storage/app/SLA/".$filename, "F");

        // $path = $request->file($pdfObj)->store('cerebro-sla/pdf', 's3');

        $s3pdf = $pdf->Output($filename, "S");

        // $path = $request->file($s3pdf)->store('pdf', 's3');

        // Storage::disk('local')->put('SLA/Business_SLA(Services).pdf', $newpdf);

        Storage::disk('s3')->put('pdf/'.$filename, $s3pdf);

        // return view('NewPDF')->with('pdf',json_decode($pdf));
        return view('NewPDF', compact('pdf'));
    }

    public function s3upload(Request $request)
    {
        // $pdfObj = $request->pdf;
        // dd(env('AWS_DEFAULT_REGION'));
        // dd(config('filesystems.disks.s3'));

        $path = $request->file('pdf')->store('pdf', 's3');
        if($path){
            return back()->with('upload_success','file uploaded successfully');
        }

    }
}
