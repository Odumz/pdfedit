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
    

    public function editTalentSLA(Request $request)
    {
        $talentName = $request->talentName;
        $clientName = $request->clientName;
        $serviceName = $request->serviceName;
        $description = $request->description;
        $duration = $request->duration;
        $dateOfCommencement = $request->dateOfCommencement;
        $durationTo = $request->durationTo;
        $amount = $request->amount;
        $serviceProviderSignature = $request->serviceProviderSignature;
        $serviceProviderDate = $request->serviceProviderDate;
        $talentSignature = $request->talentSignature;
        $talentDate = $request->talentDate;


        $info = [
            'talentName' => $talentName,
            'clientName' => $clientName,
            'serviceName' => $serviceName,
            'description' => $description,
            'duration' => $duration,
            'dateOfCommencement' => $dateOfCommencement,
            'amount' => $amount,
            'serviceProviderSignature' => $serviceProviderSignature,
            'serviceProviderDate' => $serviceProviderDate,
            'talentSignature' => $talentSignature,
            'talentDate' => $talentDate
      

        ];

        // dd($info);

        // Create new Landscape PDF
        $pdf = new FPDI();

        // Reference the PDF you want to use (use relative path)
        $pagecount = $pdf->setSourceFile( 'Cerebro_Talent_SLA.pdf' );
        
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();
        
        // Use the imported page as the template
        $pdf->useTemplate($tpl);
        
        // // Set the default font to use
        $pdf->SetFont('Helvetica');
        
        // // adding a Cell using:
        // // $pdf->Cell( $width, $height, $text, $border, $fill, $align);
        
        // // PAGE ONE
        
        $pdf->SetFontSize('12'); // set font size
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(19, 194); // set the position of the box
        $pdf->Cell(15, 5, $talentName, 0, 0, 'L'); // add the text, align to Center of cell
        
        
        $pdf->SetFontSize('12'); // set font size
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(46, 211.5); // set the position of the box
        $pdf->Cell(10, 5, $clientName, 0, 0, 'L'); // add the text, align to Center of cell
        
        $pdf->SetFontSize('12'); // set font size
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(55, 261.5); // set the position of the box
        $pdf->Cell(10, 5, $serviceName, 0, 0, 'L');// add the text, align to Center of cell
        
        // // PAGE TWO
        // // // note the reduction in font and different box position
        
        $tpl = $pdf->importPage(2);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(51, 27);
        $pdf->Cell(5, 5, $description, 0,0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(46, 34.5);
        $pdf->Cell(5, 5, $duration, 0, 0, 'L');
        $pdf->Cell(5, 5, 'days ', 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(89, 42);
        $pdf->Cell(5, 5, $dateOfCommencement, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(67, 50);
        $pdf->Cell(4, 5, 'N', 0, 0, 'L');
        $pdf->Cell(5, 5, $amount, 0, 0, 'L');
        
        // $pdf->SetFontSize('12');
        // $pdf->SetTextColor(80,80,80);
        // $pdf->SetXY(62, 78);
        // $pdf->Cell(5, 5, '6', 0, 0, 'L');
        
        // //PAGE THREE
        
        $tpl = $pdf->importPage(3);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        
        // //PAGE FOUR
        
        $tpl = $pdf->importPage(4);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        // //Page 5
        
        $tpl = $pdf->importPage(5);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(88, 93);
        $pdf->Cell(10, 5, $serviceProviderSignature, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(132,93);
        $pdf->Cell(5, 5, $serviceProviderDate, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(20, 108);
        $pdf->Cell(10, 5, $talentName, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(88, 108);
        $pdf->Cell(10, 5, $talentSignature, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(132, 108);
        $pdf->Cell(5, 5, $talentDate, 0, 0, 'L');
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

    public function editBusinessSLA(Request $request)
    {
        $clientName = $request->clientName;
        $serviceName = $request->serviceName;
        $description = $request->description;
        $duration = $request->duration;
        $dateOfCommencement = $request->dateOfCommencement;
        $amount = $request->amount;
        $reviewSession = $request->reviewSession;
        $serviceProviderSignature = $request->serviceProviderSignature;
        $serviceProviderDate = $request->serviceProviderDate;
        $clientSignature = $request->clientSignature;
        $clientDate = $request->clientDate;
       

        $info = [
            'clientName' => $clientName,
            'serviceName' => $serviceName,
            'description' => $description,
            'duration' => $duration,
            'dateOfCommencement' => $dateOfCommencement,
            'amount' => $amount,
            'reviewSession' => $reviewSession,
            'serviceProviderSignature' => $serviceProviderSignature,
            'serviceProviderDate' => $serviceProviderDate,
            'clientSignature' => $clientSignature,
            'clientDate' => $clientDate
           
        ];

        // dd($info);

        $pdf = new FPDI();

        // Reference the PDF you want to use (use relative path)
        $pagecount = $pdf->setSourceFile( 'Cerebro_Business_SLA.pdf' );
        
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();
        
        //Use the imported page as the template
        $pdf->useTemplate($tpl);
        
        // // Set the default font to use
        $pdf->SetFont('Helvetica');
        
        // // adding a Cell using:
        // // $pdf->Cell( $width, $height, $text, $border, $fill, $align);
        
        // PAGE ONE
        
        $pdf->SetFontSize('12'); // set font size
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(22, 195); // set the position of the box
        $pdf->Cell(20, 5, $clientName, 0, 0, 'L'); // add the text, align to Center of cell
        
        
        // PAGE TWO
        // // note the reduction in font and different box position
        
        $tpl = $pdf->importPage(2);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(58, 40);
        $pdf->Cell(10, 5, $serviceName, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(53, 47);
        $pdf->Cell(5, 5, $description, 0,0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(47, 55);
        $pdf->Cell(5, 5, $duration, 0, 0, 'L');
        $pdf->Cell(5, 5, 'days ', 0, 0, 'L');
        
        // $pdf->SetFontSize('12');
        // $pdf->SetTextColor(80,80,80);
        // $pdf->SetXY(92,63);
        // $pdf->Cell(5, 5, date('d'), 0, 0, 'L');
        // $pdf->Cell(5, 5, date('M'), 0, 0, 'L');
        // $pdf->Cell(9, 5, date('y'), 0, 0, 'R');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(92,63);
        $pdf->Cell(5, 5, $dateOfCommencement, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(70, 71);
        $pdf->Cell(4, 5, 'N', 0, 0, 'L');
        $pdf->Cell(5, 5, $amount, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(62, 78);
        $pdf->Cell(5, 5, $reviewSession, 0, 0, 'L');
        
        //PAGE THREE
        
        $tpl = $pdf->importPage(3);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        
        //PAGE FOUR
        
        $tpl = $pdf->importPage(4);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        //Page 5
        
        $tpl = $pdf->importPage(5);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        //Page 6
        
        $tpl = $pdf->importPage(6);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');
        
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(91, 43);
        $pdf->Cell(10, 5, $serviceProviderSignature, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(134,43);
        $pdf->Cell(5, 5, $serviceProviderDate, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(23, 63);
        $pdf->Cell(10, 5, $clientName, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(91, 63);
        $pdf->Cell(10, 5, $clientSignature, 0, 0, 'L');
        
        $pdf->SetFontSize('12');
        $pdf->SetTextColor(80,80,80);
        $pdf->SetXY(134, 63);
        $pdf->Cell(5, 5, $clientDate, 0, 0, 'L');
        
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

        $path = $request->file('pdf')->store('cerebro/pdf', 's3');
        if($path){
            return back()->with('upload_success','file uploaded successfully');
        }

    }
}
