<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    /**
     * Display a listing of pending users.
     */
    public function index()
    {
        // Show ALL pending users including employees
        $pendingUsers = User::with('role')
            ->where('is_approved', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // Show ALL approved users including employees
        $approvedUsers = User::with('role')
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('approval.index', compact('pendingUsers', 'approvedUsers'));
    }

    /**
     * Approve a user.
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->route('approval.index')->with('success', "User '{$user->name}' has been approved successfully!");
    }

    /**
     * Reject a user (delete).
     */
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $userName = $user->name;
        $user->delete();

        return redirect()->route('approval.index')->with('success', "User '{$userName}' has been rejected and removed from the system.");
    }

    /**
     * Revoke approval (deactivate user).
     */
    public function revoke($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = false;
        $user->save();

        return redirect()->route('approval.index')->with('warning', "User '{$user->name}' approval has been revoked.");
    }
}
