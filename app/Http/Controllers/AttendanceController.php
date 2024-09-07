<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DateTime; 
use DateInterval; 
use DatePeriod; 
use Dompdf\Dompdf;
use Dompdf\Options;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        if ($user->role == 'admin') {
            // Fetch all attendances for admin
            $attendances = Attendance::orderBy('id', 'desc')->get();
        } else {
            // Fetch only the attendances for the currently logged-in user
            $attendances = Attendance::where('user_id', $user->id)
                                     ->orderBy('id', 'desc')
                                     ->get();
        }
    
        return view('attendance.index', compact('attendances'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendance.upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $request->validate([       
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        $existingAttendance = Attendance::where('user_id', Auth::id())
                                    ->whereDate('date', $request->date)
                                    ->first();

            if ($existingAttendance) {
                return redirect()->back()->with('error', 'Attendance for this date already recorded.');
            }

            Attendance::create([
                'user_id' => Auth::id(),
                'date' => $request->date,
                'status' => $request->status,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'area' => $request->sub_area,
            ]);

        return redirect()->route('attendance')->with('success', 'Attendance recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
{
    $attendances = Attendance::where('user_id', Auth::id())->get();

    $events = [];

    // Add attendance events
    foreach ($attendances as $attendance) {
        $createdTime = strtotime($attendance->created_at);
        $lateTime = strtotime(date('Y-m-d') . ' 11:00:00');

        if ($createdTime > $lateTime) {
            $events[] = [
                'title' => 'Half day',
                'start' => $attendance->date,
                'backgroundColor' => 'blue',
                'borderColor' => 'white',
            ];
        } else {
            $events[] = [
                'title' => $attendance->status,
                'start' => $attendance->date,
                'backgroundColor' => 'green',
                'borderColor' => 'white',
            ];
        }
    }

    // Add "Week Off" for all Sundays
    $start = new DateTime('first day of this month');
    $end = new DateTime('last day of this month');
    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($start, $interval, $end);

    foreach ($daterange as $date) {
        if ($date->format('N') == 7) { // 7 corresponds to Sunday
            $events[] = [
                'title' => 'Week Off',
                'start' => $date->format('Y-m-d'),
                'backgroundColor' => 'gray',
                'borderColor' => 'white',
            ];
        }
    }

    return view('attendance.calendar', ['events' => json_encode($events)]);
}

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leave = Attendance::find($id); 
        return view('attendance.edit',compact('leave'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'status' => 'required',
            
        ]);
       
        $attendance->update($validatedData);
        
        return redirect()->route('attendance')->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();    
    
        return redirect()->route('attendance')->with('success', 'Attendance record deleted successfully');
    }

    public function downloadAttendance()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
    
        $user = Auth::user();

        if ($user->role == 'admin') {       
            $attendances = Attendance::whereYear('date', $currentYear)
                                    ->whereMonth('date', $currentMonth)
                                    ->get();
        } else {
        
            $attendances = Attendance::where('user_id', $user->id)
                                    ->whereYear('date', $currentYear)
                                    ->whereMonth('date', $currentMonth)
                                    ->get();
        }
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new Dompdf($options);    
        
        $html = view('attendance.attendence', compact('attendances'))->render();
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
        return $dompdf->stream('attendance.pdf');
    }
    
}
