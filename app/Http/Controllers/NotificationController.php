<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $notifications = Notification::orderBy("created_at", "desc")->get();
        $notifications = DB::table('notifications')
            ->join('users', 'notifications.reciepient', '=', 'users.id')
            ->select('notifications.*', 'users.name as reciepient')
            ->latest()
            ->get();
        return view('admin.notification.index', compact('notifications'));
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = User::where('role', 'agent')->latest()->get();
        return view('admin.notification.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'reciepient' => 'required',
            'description' => 'required',
        ]);


        $notice = new Notification();
        $notice->title =  $request->title;
        $notice->reciepient =  $request->reciepient;
        $notice->description = $request->description;

        $notice->save();

        return redirect('notification')->with('message', 'Notification Sent');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        $agents = User::where('role', 'agent')->latest()->get();
        return view('admin.notification.edit', compact('notification', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'reciepient' => 'required',
            'description' => 'required',
        ]);

        $notice = Notification::findOrFail($id);
        $notice->title =  $request->title;
        $notice->reciepient =  $request->reciepient;
        $notice->description = $request->description;

        $notice->save();

        return redirect('notification')->with('message', 'Notification Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notice = Notification::findOrFail($id);
        $notice->delete();

        return redirect('notification')->with('message', 'Notification Deleted');
    }
}
