<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Order;
use App\Models\Setting;
use App\Services\SmsService;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $smsService;
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            return redirect()->route('user-profile.index');
        }
    
        $smsResult = $this->smsService->checkBalance();
    
        if ($smsResult['status'] != 1) {
            return response([
                'message' => 'Failed to check balance',
                'error_details' => $smsResult['error_message'] ?? 'Unknown error',
            ]);
        }
    
        $balance = $smsResult['balance'];
        $balance = str_replace('trans1:', '', $balance);
    
        $userCount = User::count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $clientCount = Client::count();
    
        $latestOrders = Order::orderBy('created_at', 'desc')->limit(7)->get();
        $today = date('Y-m-d');
        $todayOrders = Order::whereDate('created_at', $today)
                     ->orderBy('created_at', 'desc')
                     ->limit(7)
                     ->get();

        $salesData = Order::selectRaw('SUM(total) as total, MONTH(created_at) as month, YEAR(created_at) as year')
            ->groupBy('year', 'month')
            ->whereYear('created_at', date('Y'))
            ->get()
            ->keyBy('month');
    
        $thisYearSales = [];
        $lastYearSales = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
        foreach ($months as $index => $month) {
            $thisYearSales[$index] = $salesData->get($index + 1)->total ?? 0;
            $lastYearSales[$index] = Order::selectRaw('SUM(total) as total')
                ->whereMonth('created_at', $index + 1)
                ->whereYear('created_at', date('Y') - 1)
                ->first()
                ->total ?? 0;
        }
    
        // Calculate sales total and increase
        $salesTotal = array_sum($thisYearSales);
        $lastYearTotal = array_sum($lastYearSales);
        $salesIncrease = $lastYearTotal ? (($salesTotal - $lastYearTotal) / $lastYearTotal) * 100 : 0;
    
        return view('home', [
            'user' => $userCount,
            'category' => $categoryCount,
            'product' => $productCount,
            'order' => $orderCount,
            'todayOrders'=>$todayOrders,
            'latestOrders'=>$latestOrders,
            'salesTotal' => number_format($salesTotal, 2),
            'salesIncrease' => number_format($salesIncrease, 1),
            'thisYearSales' => $thisYearSales,
            'lastYearSales' => $lastYearSales,
            'months' => $months,
        ]);
    }
    
    


    function test_balance()
    {
        
        $smsResult = $this->smsService->checkBalance();     
    
        if ($smsResult['status'] != 1) {
            return response([
                'message' => 'Failed to check balance',
                'error_details' => $smsResult['error_message'] ?? 'Unknown error',
            ]);
        }
    
        $balance = $smsResult['balance'];
    
        return response([
            'message' => 'Balance checked successfully',
            'status' => $smsResult['status'],
            'balance' => $balance,
        ]);
    }


    public function profile()
    {    
      
        $teacher = Auth::user();
      
        return view('profile', compact('teacher'));
    }

    public function teacher_index()
    {
        $userId = Auth::id();
        $attendance = Attendance::where('user_id', $userId)->count(); 
        $leave = Leave::where('user_id', $userId)->count();
        $payslip = Payslip::where('user_id', $userId)->count();     
    
        // Fetch holidays using the correct model
        $holidays = Holiday::all()->map(function($holiday) {
            return [
                'title' => $holiday->name,
                'start' => $holiday->date->format('Y-m-d'),
                'backgroundColor' => $holiday->status === 'Active' ? 'rgba(255, 99, 132, 0.5)' : 'rgba(201, 203, 207, 0.5)',
                'borderColor' => $holiday->status === 'Active' ? 'rgba(255, 99, 132, 1)' : 'rgba(201, 203, 207, 1)',
            ];
        });
    
        return view('teacher_dashboard', [
            'attendance' => $attendance,
            'payslip' => $payslip,
            'leave' => $leave,
            'events' => $holidays,
        ]);
    }
    
    
   
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Hash the new password
        $user->password = Hash::make($request->new_password);

        // Save the updated user model
        if ($user->save()) {
            return redirect()->back()->with('success', 'Password changed successfully.');
        } else {
            return redirect()->back()->withErrors(['general' => 'There was a problem saving your new password.']);
        }
    }


    public function setting()
    {
        $setting = Setting::first(); 
        return view('setting', compact('setting'));
    }
    

    public function update(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_no' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gst_no' => 'nullable|string|max:20',
            'pan_card' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bank_account' => 'nullable|string|max:255',
        ]);
    
        $setting = Setting::first(); // Adjust this if you need to find a specific setting or user
    
        $data = $request->only([
            'business_name',
            'email',
            'mobile_no',
            'address',
            'gst_no',
            'pan_card',
            'bank_account',
        ]);
    
        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::delete($setting->logo); // Delete old logo if exists
            }
    
            $path = $request->file('logo')->store('logos');
            $data['logo'] = $path;
        }
    
        $setting->update($data);
    
        return redirect()->route('setting')->with('success', 'Settings updated successfully.');
    }
    
    
        
}
