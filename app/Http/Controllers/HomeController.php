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
        // $durationTo = $request->durationTo;
        $amount = $request->amount;
        $serviceProviderSignature = $request->serviceProviderSignature;
        // $serviceProviderDate = $request->serviceProviderDate;
        $talentSignature = $request->talentSignature;
        // $talentDate = $request->talentDate;
        $talentInitials = $request->talentInitials;
        $signatureURL = $request->signatureURL;


        // $timezone = date_default_timezone_get();
        // date_default_timezone_set($timezone);
        date_default_timezone_set('Africa/Lagos');
        $signDate = date('d-m-Y');


        $info = [
            'talentName' => $talentName,
            'clientName' => $clientName,
            'serviceName' => $serviceName,
            'description' => $description,
            'duration' => $duration,
            'dateOfCommencement' => $dateOfCommencement,
            'amount' => $amount,
            'serviceProviderSignature' => $serviceProviderSignature,
            // 'serviceProviderDate' => $serviceProviderDate,
            'talentSignature' => $talentSignature,
            // 'talentDate' => $talentDate,
            'signDate' => $signDate,
            'talentInitials' => $talentInitials,
            'signatureURL' => $signatureURL,

        ];

        // dd($info);

        // Create new Landscape PDF
        $pdf = new FPDI();

        // Reference the PDF you want to use (use relative path)
        $pagecount = $pdf->setSourceFile( 'Cerebro_Talent_SLA_5068.pdf' );

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

        $pdf->SetFontSize('11.5'); // set font size
        $pdf->SetFont('Helvetica', 'BI'); // set font face
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(20, 216.5); // set the position of the box
        $pdf->Cell(15, 5, $talentName, 0, 0, 'L'); // add the text, align to Center of cell


        $pdf->SetFontSize('11.5'); // set font size
        $pdf->SetFont('Helvetica', 'BI'); // set font face
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(20, 239.5); // set the position of the box
        $pdf->Cell(10, 5, $clientName, 0, 0, 'L'); // add the text, align to Center of cell

        // // PAGE TWO
        // // // note the reduction in font and different box position

        $tpl = $pdf->importPage(2);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');

        $pdf->SetFontSize('11.5'); // set font size
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(45, 40); // set the position of the box
        $pdf->Cell(10, 5, $serviceName, 0, 0, 'L');// add the text, align to Center of cell

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(42, 48.4);
        // $pdf->Cell(5, 5, $description, 0,0, 'L');
        $pdf->MultiCell(140, 5.5, $description, 'J');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(37, 66);
        $pdf->Cell(5, 5, $duration, 0, 0, 'L');
        // $pdf->Cell(5, 5, 'days ', 0, 0, 'L');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(71, 74.7);
        $pdf->Cell(5, 5, $dateOfCommencement, 0, 0, 'L');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(54, 83.4);
        $pdf->Cell(4, 5, 'N', 0, 0, 'L');
        $pdf->Cell(5, 5, $amount, 0, 0, 'L');

        // $pdf->SetFontSize('11.5');
        // $pdf->SetTextColor(95,95,95);
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


        // $pdf->SetFontSize('11.5');
        // $pdf->SetTextColor(95,95,95);
        // $pdf->SetXY(88, 93);
        // $pdf->Cell(10, 5, $serviceProviderSignature, 0, 0, 'L');

        // Cerebro Signature
        // $pdf->Image('https://res.cloudinary.com/ekoicentre/image/upload/v1591110373/Cerebro/python_vu340t.png',97,110,20,0,'PNG');
        $pdf->Image('https://res.cloudinary.com/dwpu7jpku/image/upload/v1594234198/signature_tjv42q.png',97,115,27,0,'PNG');
        // $pdf->Image($serviceProviderSignature, 97, 115, 27, 0, 'PNG');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(132,118);
        $pdf->Cell(5, 5, $signDate, 0, 0, 'L');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(19, 128);
        // $pdf->Cell(10, 5, $talentName, 0, 0, 'L');
        $pdf->MultiCell(28, 5, $talentName, 'J');

        // $pdf->SetFontSize('11.5');
        // $pdf->SetTextColor(95,95,95);
        // $pdf->SetXY(88, 108);
        // $pdf->Cell(10, 5, $talentSignature, 0, 0, 'L');

        //Client | Talent Signature
        if ($talentSignature == "initial") {
            $pdf->SetFontSize('11.5');
            $pdf->SetFont('Helvetica', 'B');
            $pdf->SetTextColor(95,95,95);
            $pdf->SetXY(100, 135);
            // $pdf->Cell(10, 5, 'TLS', 0, 0, 'L');
            $pdf->Cell(10, 5, $talentInitials, 0, 0, 'L');
        } elseif ($talentSignature == "signature" ) {
            $pdf->Image('https://res.cloudinary.com/dwpu7jpku/image/upload/v1594234198/signature_tjv42q.png',97,132,27,0,'PNG');
            // $pdf->Image($signatureURL, 97, 132, 27, 0, 'PNG');
        }

        // talent date
        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetFont('Helvetica', '');
        $pdf->SetXY(132, 134);
        $pdf->Cell(5, 5, $signDate, 0, 0, 'L');

        // render PDF to browser

        $filename=$talentName.'_Cerebro_Talent_SLA.pdf';

        // $pdf->Output($filename, "I");

        //store pdf on local
        // $newpdf = $pdf->Output("/var/www/html/pdf-edit/storage/app/SLA/".$filename, "F");

        // $path = $request->file($pdfObj)->store('cerebro-sla/pdf', 's3');

        // write pdf to string
        $s3pdf = $pdf->Output($filename, "S");

        // $path = $request->file($s3pdf)->store('pdf', 's3');

        // Storage::disk('local')->put('SLA/Business_SLA(Services).pdf', $newpdf);

        // store pdf string in s3 bucket
        Storage::disk('s3')->put(''.$serviceName.'/'.$filename, $s3pdf);

        // returns url to object in s3 bucket
        $url = Storage::url(''.$serviceName.'/'.$filename);

        // return view('NewPDF')->with('pdf',json_decode($pdf));
        return $url;
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
        // $serviceProviderDate = $request->serviceProviderDate;
        $clientSignature = $request->clientSignature;
        // $clientDate = $request->clientDate;
        $clientInitials = $request->clientInitials;
        $signatureURL = $request->signatureURL;

        // $timezone = date_default_timezone_get();
        // date_default_timezone_set($timezone);
        date_default_timezone_set('Africa/Lagos');
        $signDate = date('d-m-Y');


        $info = [
            'clientName' => $clientName,
            'serviceName' => $serviceName,
            'description' => $description,
            'duration' => $duration,
            'dateOfCommencement' => $dateOfCommencement,
            'amount' => $amount,
            'reviewSession' => $reviewSession,
            'serviceProviderSignature' => $serviceProviderSignature,
            // 'serviceProviderDate' => $serviceProviderDate,
            'clientSignature' => $clientSignature,
            // 'clientDate' => $clientDate
            'signDate' => $signDate,
            'clientInitials' => $clientInitials,
            'signatureURL' => $signatureURL,

        ];

        // dd($info);

        $pdf = new FPDI();

        // Reference the PDF you want to use (use relative path)
        $pagecount = $pdf->setSourceFile( 'Cerebro_Business_SLA_5068.pdf' );

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

        $pdf->SetFontSize('11.5'); // set font size
        $pdf->SetFont('Helvetica', 'BI'); // set font face
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(21, 215); // set the position of the box
        $pdf->Cell(20, 5, $clientName, 0, 0, 'L'); // add the text, align to Center of cell


        // PAGE TWO
        // // note the reduction in font and different box position

        $tpl = $pdf->importPage(2);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(48, 45.7);
        $pdf->Cell(10, 5, $serviceName, 0, 0, 'L');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(45, 54.4);
        // $pdf->Cell(5, 5, $description, 0,0, 'L');
        $pdf->MultiCell(140, 5.5, $description, 'J');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(40, 71.9);
        $pdf->Cell(5, 5, $duration, 0, 0, 'L');
        // $pdf->Cell(5, 5, 'days ', 0, 0, 'L');

        // $pdf->SetFontSize('11.5');
        // $pdf->SetTextColor(95,95,95);
        // $pdf->SetXY(92,63);
        // $pdf->Cell(5, 5, date('d'), 0, 0, 'L');
        // $pdf->Cell(5, 5, date('M'), 0, 0, 'L');
        // $pdf->Cell(9, 5, date('y'), 0, 0, 'R');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(74, 80.4);
        $pdf->Cell(5, 5, $dateOfCommencement, 0, 0, 'L');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(56.5, 89.4);
        $pdf->Cell(4, 5, 'N', 0, 0, 'L');
        $pdf->Cell(5, 5, $amount, 0, 0, 'L');

        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(53, 97.8);
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

        // $tpl = $pdf->importPage(6);
        // $pdf->AddPage();
        // $pdf->useTemplate($tpl);
        // $pdf->SetFont('Helvetica');


        // $pdf->SetFontSize('11.5');
        // $pdf->SetTextColor(95,95,95);
        // $pdf->SetXY(91, 43);
        // $pdf->Cell(10, 5, $serviceProviderSignature, 0, 0, 'L');

        // service provider Signature
        // $pdf->Image('https://res.cloudinary.com/ekoicentre/image/upload/v1591110373/Cerebro/python_vu340t.png',97,208,20,0,'PNG');
        $pdf->Image('https://res.cloudinary.com/dwpu7jpku/image/upload/v1594234198/signature_tjv42q.png',97,212,27,0,'PNG');
        // $pdf->Image($serviceProviderSignature, 99, 212, 27, 0, 'PNG');

        // service provider date
        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        // $pdf->SetFont('Helvetica', 'B');
        $pdf->SetXY(140, 216);
        $pdf->Cell(5, 5, $signDate, 0, 0, 'L');

        // client name
        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        $pdf->SetXY(21.5, 228.5);
        // $pdf->Cell(10, 5, $clientName, 0, 0, 'L');
        $pdf->MultiCell(28, 5, $clientName, 'J');

        // $pdf->SetFontSize('11.5');
        // $pdf->SetTextColor(95,95,95);
        // $pdf->SetXY(91, 63);
        // $pdf->Cell(10, 5, $clientSignature, 0, 0, 'L');

        //Client | Talent Signature
        if ($clientSignature == "initial") {
            $pdf->SetFontSize('11.5');
            $pdf->SetFont('Helvetica', 'B');
            $pdf->SetTextColor(95,95,95);
            $pdf->SetXY(100, 235);
            // $pdf->Cell(10, 5, 'CLS', 0, 0, 'L');
            $pdf->Cell(10, 5, $clientInitials, 0, 0, 'L');
        } elseif ($clientSignature == "signature" ) {
            // $pdf->Image('https://res.cloudinary.com/ekoicentre/image/upload/v1591110373/Cerebro/python_vu340t.png',97,227,20,0,'PNG');
            $pdf->Image('https://res.cloudinary.com/dwpu7jpku/image/upload/v1594234198/signature_tjv42q.png',97,230,27,0,'PNG');
            // $pdf->Image($signatureURL, 99, 230, 27, 0, 'PNG');
        }

        // $pdf->Image('https://res.cloudinary.com/ekoicentre/image/upload/v1591110373/Cerebro/python_vu340t.png',95,112,25,0,'PNG');
        // $pdf->Image($clientSignature, 95, 112, 25, 0, 'PNG');

        // client date
        $pdf->SetFontSize('11.5');
        $pdf->SetTextColor(95,95,95);
        // $pdf->SetFont('Helvetica', 'B');
        $pdf->SetXY(140, 232);
        $pdf->Cell(5, 5, $signDate, 0, 0, 'L');

        // render PDF to browser

        $filename=$clientName.'_Cerebro_Business_SLA.pdf';

        // $pdf->Output($filename, "I");

        // $newpdf = $pdf->Output("/var/www/html/pdf-edit/storage/app/SLA/".$filename, "F");

        // $path = $request->file($pdfObj)->store('cerebro-sla/pdf', 's3');

        $s3pdf = $pdf->Output($filename, "S");

        // $path = $request->file($s3pdf)->store('pdf', 's3');

        // Storage::disk('local')->put('SLA/Business_SLA(Services).pdf', $newpdf);

        // stores pdf to s3 bucket
        Storage::disk('s3')->put(''.$serviceName.'/'.$filename, $s3pdf);

        // returns pdf url
        $url = Storage::url(''.$serviceName.'/'.$filename);

        // return view('NewPDF')->with('pdf',json_decode($pdf));
        return $url;
    }
}
