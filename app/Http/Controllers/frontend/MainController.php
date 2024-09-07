<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Contact;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\Testimonial;
use App\Models\Review;
use App\Mail\ContactMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MainController extends Controller
{
    public function index()
    {
        Log::alert("This is a debug message.");
        $products = Product::where('status', 1)->get(); 
        $banners = Banner::where('status', 1)->get(); 
        $testimonials = Testimonial::where('status', 1)->get();           
        $bestsellingProducts = Product::orderBy('id', 'desc')->paginate(6);
        $setting = Setting::first(); 

        return view('frontend/home', [
            'products' => $products,
            'banners' => $banners,
            'testimonials' => $testimonials,
            'setting' => $setting,
            'bestsellingProducts' => $bestsellingProducts
        ]);
    }

    

    public function about()
    {       
        return view('frontend/about');
    }
    public function contact()
    {
        $setting = Setting::first(); 
        return view('frontend.contact', compact('setting'));
    }
    public function cart()
    {
        
        return view('frontend/cart');
    }

    public function product_detail($id)
    {
        $product = Product::with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc') 
                  ->limit(10); 
        }])->findOrFail($id);

        $relatedProducts = Product::where('subcategory_id', $product->subcategory_id)
                                  ->where('id', '!=', $product->id)
                                  ->get();

        $averageRating = $product->reviews->avg('rating');

        return view('frontend.product_details', compact('product', 'relatedProducts','averageRating'));
    }
    
    
  
     public function privacy()
        {
            return view('frontend/privacy');
        }
    
     public function term()
        {
            return view('frontend/term');
        }
    
     public function faq()
        {
            return view('frontend/faq');
        }
    
        public function return()
        {
            return view('frontend/return');
        }
    
     

        public function product(Request $request)
        {
            $sort = $request->input('sort', 'relevance');
            $subcategoryId = $request->input('subcategory');
        
            $query = Product::query();
        
            if ($subcategoryId) {
                $query->where('subcategory_id', $subcategoryId);
            }
        
            switch ($sort) {
                case 'low_to_high':
                    $query->orderBy('price', 'asc');
                    break;
                case 'high_to_low':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        
            $subcategoryCounts = SubCategory::withCount('products')->get();
            $products = $query->paginate(12);
        
            return view('frontend.product', compact(['products', 'subcategoryCounts']));
        }
        
        
        
    
    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mobile_no' => 'required|numeric|digits_between:10,15',
                'message' => 'required|string',
            ]);    
    
            $contact = Contact::create($validatedData);
            
            Mail::to($validatedData['email'])->send(new ContactMail());
            
            return response()->json(['success' => 'Data inserted successfully']);
        }
        

        public function showLoginForm()
        {
            return view('frontend.customer');
        }


        function showRegistrationForm(){
            return view('frontend.register');
        }

}
