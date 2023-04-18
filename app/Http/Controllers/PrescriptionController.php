<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Booking;
use App\Models\Prescription;
use App\Models\PrescriptionMedicines;
use App\Models\Doctor;
use App\Models\User;
use Dompdf\Dompdf;
use DB;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        $doctorID = Doctor::where('user_id', auth()->user()->id)->first();
        $bookings = Booking::where('app_date','>=', date('Y-m-d'))->where('book_status', 2)->where('doctor_id', $doctorID->id)->paginate(5);

        return view('prescription.index', compact('bookings', 'doctorID'));
    }

    public function create($id, $date,$doctorID)
    {
        $bookings = Booking::where('user_id', $id)->where('app_date', $date)->where('doctor_id', $doctorID)->first();
        return view('prescription.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        

        $prescription = Prescription::create([
            'pres_findings' => $request->pres_findings,
                'user_id' => $request->user_id,
                'doctor_id' => $request->doctor_id,
                'app_date' => $request->app_date,
                'charge' => $request->charge,
        ]);
        
        $medicine_name = $request->medicine_name;
        $medicine_frequency = $request->medicine_frequency;
        $medicine_duration = $request->medicine_duration;

        for($i=0; $i < count($medicine_name); $i++)
        {
            PrescriptionMedicines::create([
                'prescription_id' => $prescription->id,
                'medicine_name' => $medicine_name[$i],
                'medicine_frequency' => $medicine_frequency[$i],
                'medicine_duration' => $medicine_duration[$i],
            ]);
        }

        $booking = Booking::find($request->book_id);
        $booking->book_status = 6;
        $booking->save(); 
                
        return redirect()->route('patients.today')->with('message','Prescription Created');
    }
    
    public function show($userID, $date)
    {
        $prescription1 = Prescription::where('user_id', $userID)->where('app_date', $date)->first();
        $prescriptions = PrescriptionMedicines::where('prescription_id', $prescription1->id)->get();
       return view('prescription.showPrescription2',compact('prescriptions', 'prescription1'));
    }

    // public function show($userID, $date)
    // {
    //     $prescription1 = Prescription::where('user_id', $userID)->where('app_date', $date)->first();
    //     $prescriptions = PrescriptionMedicines::where('prescription_id', $prescription1->id)->get();
    //    return view('prescription.showPrescription2',compact('prescriptions', 'prescription1'));
    // }

    public function prescribedPatient()
    {
        // $patients = Prescription::groupBy('user_id')->get();
        $patients = User::where('role_id', '4')->orderBy('user_lName', 'asc')->get();
        return view('prescription.all', compact('patients'));
    }

    public function showHistory($id)
    {
        $user = User::where('id', $id)->first();
        $prescriptions = Prescription::where('user_id', $id)->orderBy('app_date', 'desc')->get();
        
        return view('prescription.showMedical', compact('prescriptions', 'user')); 
    }

    public function chargeReport(Request $request)
    {
        if (Auth::user()->role->name=="patient") {
            return view('home');
        }
        // $report = Prescription::selectRaw('*, month(str_to_date(date, "%d-%m-%Y")) as app_date')->get();
        
        // $dataReport = $report->where('')
        $date = Prescription::select([
            DB::raw("DATE_FORMAT(created_at, '%Y') as years")
        ])->groupBy('years')->get();
       

        if($request->years){
            $data = Prescription::select([
                DB::raw("DATE_FORMAT(created_at,'%Y') as months"),
                DB::raw('sum(charge)as charge')
            ])->whereYear(DB::raw('date(created_at)'),'=', $request['years'])
                ->orderBy('created_at', 'asc')
                ->groupBy('months')
                ->get();
                return view('patientlist.salesReport', compact('data','date'));
        }
         
            $data = Prescription::select([
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
                DB::raw('sum(charge)as charge')
            ])->where(DB::raw('date(created_at)'),'>=', \Carbon\Carbon::now()->subMonths(12))
                ->orderBy('created_at', 'asc')
                ->groupBy('months')
                ->get();         
        

        
        return view('patientlist.salesReport', compact('data','date'));
    }
}
