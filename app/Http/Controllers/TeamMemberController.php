<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Department;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamMembers = TeamMember::with('department')->orderBy('first_name')->get();
        return view('team-members.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('is_active', true)->orderBy('name')->get();
        return view('team-members.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'employee_id' => 'required|string|max:50|unique:team_members',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:team_members',
            'phone' => 'nullable|string|max:50',
            'position' => 'required|string|max:255',
            'role' => 'required|in:developer,analyst,manager,tester,designer,architect,devops,other',
            'seniority' => 'required|in:junior,mid,senior,lead',
            'skills' => 'nullable|string',
            'bio' => 'nullable|string',
            'hire_date' => 'nullable|date',
        ]);

        TeamMember::create($request->all());

        return redirect()->route('team-members.index')
            ->with('success', 'Miembro del equipo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        $teamMember->load('department');
        return view('team-members.show', compact('teamMember'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        $departments = Department::where('is_active', true)->orderBy('name')->get();
        return view('team-members.edit', compact('teamMember', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'employee_id' => 'required|string|max:50|unique:team_members,employee_id,' . $teamMember->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:team_members,email,' . $teamMember->id,
            'phone' => 'nullable|string|max:50',
            'position' => 'required|string|max:255',
            'role' => 'required|in:developer,analyst,manager,tester,designer,architect,devops,other',
            'seniority' => 'required|in:junior,mid,senior,lead',
            'skills' => 'nullable|string',
            'bio' => 'nullable|string',
            'hire_date' => 'nullable|date',
        ]);

        $teamMember->update($request->all());

        return redirect()->route('team-members.index')
            ->with('success', 'Miembro del equipo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('team-members.index')
            ->with('success', 'Miembro del equipo eliminado exitosamente.');
    }
}
