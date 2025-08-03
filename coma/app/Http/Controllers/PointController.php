<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's point history from database
        $pointHistory = Point::with(['task', 'submission'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($point) {
                return [
                    'id' => $point->id,
                    'task_title' => $point->task ? $point->task->title : $point->description,
                    'points_earned' => $point->points_earned,
                    'date' => $point->created_at->format('Y-m-d'),
                    'status' => $point->status,
                    'points_type' => $point->points_type
                ];
            });

        $totalPoints = $user->total_points;
        $totalMoney = $user->total_money;

        return view('points.index', compact('pointHistory', 'totalPoints', 'totalMoney'));
    }

    public function withdraw()
    {
        return view('points.withdraw');
    }

    public function processWithdraw(Request $request)
    {
        $request->validate([
            'points_amount' => 'required|integer|min:1000|max:' . Auth::user()->total_points,
            'payment_method' => 'required|in:bank_transfer,e_wallet',
            'bank_name' => 'required_if:payment_method,bank_transfer',
            'account_number' => 'required_if:payment_method,bank_transfer',
            'account_holder' => 'required_if:payment_method,bank_transfer',
            'ewallet_type' => 'required_if:payment_method,e_wallet',
            'ewallet_number' => 'required_if:payment_method,e_wallet',
        ]);

        $user = Auth::user();
        $pointsAmount = $request->points_amount;
        $moneyAmount = $pointsAmount * 1000; // 1 point = Rp 1,000

        // Check if user has enough points
        if ($user->total_points < $pointsAmount) {
            return back()->withErrors(['points_amount' => 'Insufficient points balance.']);
        }

        DB::transaction(function () use ($user, $pointsAmount, $moneyAmount, $request) {
            // Create withdrawal record
            $withdrawal = Withdrawal::create([
                'user_id' => $user->id,
                'points_amount' => $pointsAmount,
                'money_amount' => $moneyAmount,
                'payment_method' => $request->payment_method,
                'payment_details' => json_encode([
                    'bank_name' => $request->bank_name,
                    'account_number' => $request->account_number,
                    'account_holder' => $request->account_holder,
                    'ewallet_type' => $request->ewallet_type,
                    'ewallet_number' => $request->ewallet_number,
                ]),
                'status' => 'pending'
            ]);

            // Create point deduction record
            Point::create([
                'user_id' => $user->id,
                'points_earned' => -$pointsAmount,
                'points_type' => 'withdrawn',
                'description' => 'Withdrawal request #' . $withdrawal->id,
                'status' => 'pending'
            ]);

            // Update user's total points (temporarily reduce)
            $user->decrement('total_points', $pointsAmount);
            $user->decrement('total_money', $moneyAmount);
        });

        return redirect()->route('points.index')
            ->with('success', 'Withdrawal request submitted successfully. Processing time: 1-3 business days.');
    }
}
