<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of leave requests for the current user.
     */
    public function myLeaves()
    {
        $leaveRequests = LeaveRequest::with('employee')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('leave.my-leaves', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new leave request.
     */
    public function create()
    {
        $employee = Employee::where('user_id', Auth::id())->first();
        return view('leave.create', compact('employee'));
    }

    /**
     * Store a newly created leave request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|string|in:annual,sick,casual,unpaid,maternity,paternity',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|min:10',
        ]);

        $employee = Employee::where('user_id', Auth::id())->first();

        $leaveRequest = LeaveRequest::create([
            'user_id' => Auth::id(),
            'employee_id' => $employee?->id,
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('leave.my')
            ->with('success', 'Leave request submitted successfully! Please wait for approval.');
    }

    /**
     * Display all leave requests (for Admin/Superadmin).
     */
    public function index()
    {
        $pendingLeaves = LeaveRequest::with(['user', 'employee'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedLeaves = LeaveRequest::with(['user', 'employee'])
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        $rejectedLeaves = LeaveRequest::with(['user', 'employee'])
            ->where('status', 'rejected')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('leave.index', compact('pendingLeaves', 'approvedLeaves', 'rejectedLeaves'));
    }

    /**
     * Approve a leave request.
     */
    public function approve(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        
        $leaveRequest->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'remarks' => $request->input('remarks'),
        ]);

        // Update employee status if needed
        if ($leaveRequest->employee) {
            $leaveRequest->employee->update(['status' => 'on_leave']);
        }

        return redirect()->route('leave.index')
            ->with('success', "Leave request approved for {$leaveRequest->user->name}!");
    }

    /**
     * Reject a leave request.
     */
    public function reject(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        
        $leaveRequest->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'remarks' => $request->input('remarks'),
        ]);

        return redirect()->route('leave.index')
            ->with('warning', "Leave request rejected for {$leaveRequest->user->name}.");
    }

    /**
     * Cancel own leave request.
     */
    public function cancel($id)
    {
        $leaveRequest = LeaveRequest::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $leaveRequest->delete();

        return redirect()->route('leave.my')
            ->with('success', 'Leave request cancelled successfully.');
    }
}
