<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = User::where('role', '!=', 'admin')->latest()->get();
        return view("admin.agent.index", compact("agents"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.agent.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string'
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role', 'agent')
        ]);

        return redirect()->route('agents.index')->with('success', 'Agent created successfully.');   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent = User::findOrFail($id);
        return view("admin.agent.show", compact("agent"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent = User::findOrFail($id);
        return view("admin.agent.edit", compact("agent"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agent = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $agent->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|string'
        ]);

        if ($request->filled('password')) {
            $agent->password = bcrypt($request->input('password'));
            $agent->update(['password' => $agent->password]);
        }

        $agent->update($request->only('name', 'email', 'phone', 'address', 'role'));



        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $agent = User::findOrFail($id);
        $agent->delete();

        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }

    public function block(User $agent): RedirectResponse
    {
        abort_unless($agent->role === 'agent', 404);

        $agent->update(['role' => 'blocked']);

        return back()->with('success', 'Agent account blocked successfully.');
    }

    public function unblock(User $agent): RedirectResponse
    {
        abort_unless($agent->role === 'blocked', 404);

        $agent->update(['role' => 'agent']);

        return back()->with('success', 'Agent account unblocked successfully.');
    }
}
