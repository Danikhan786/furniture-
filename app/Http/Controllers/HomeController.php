<?php
  
namespace App\Http\Controllers;
  
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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
    public function index(): View
    {
        $user = Auth::user();
        
        // Get all orders for the user (by user_id or by email if user_id is null)
        // This ensures orders placed before login are also shown
        $orders = Order::with('items.product.images')
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere(function($q) use ($user) {
                          $q->where('email', $user->email)
                            ->whereNull('user_id');
                      });
            })
            ->latest()
            ->paginate(10);
        
        // Calculate statistics - include orders by email as well
        $totalOrders = Order::where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere(function($q) use ($user) {
                          $q->where('email', $user->email)
                            ->whereNull('user_id');
                      });
            })->count();
            
        $totalSpent = Order::where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere(function($q) use ($user) {
                          $q->where('email', $user->email)
                            ->whereNull('user_id');
                      });
            })
            ->where('status', '!=', 'cancelled')
            ->sum('total');
            
        $pendingOrders = Order::where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere(function($q) use ($user) {
                          $q->where('email', $user->email)
                            ->whereNull('user_id');
                      });
            })
            ->where('status', 'pending')
            ->count();
            
        $completedOrders = Order::where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere(function($q) use ($user) {
                          $q->where('email', $user->email)
                            ->whereNull('user_id');
                      });
            })
            ->where('status', 'completed')
            ->count();
        
        return view('home', compact(
            'orders',
            'totalOrders',
            'totalSpent',
            'pendingOrders',
            'completedOrders'
        ));
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        return view('adminHome');
    }
  
}