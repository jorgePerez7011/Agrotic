<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EvidenceController extends Controller
{
    public function index()
    {
        $evidences = Evidence::latest()->get();
        return view('evidences.index', compact('evidences'));
    }

    public function create()
    {
        return view('evidences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'boolean'
        ]);

        $evidence = new Evidence();
        $evidence->description = $request->description;
        $evidence->date = $request->date;
        $evidence->location = $request->location;
        $evidence->status = $request->has('status');

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('evidences', 'public');
            $evidence->photo = $photoPath;
        }

        $evidence->save();
        return redirect()->route('evidences.index')->with('success', 'Evidencia creada exitosamente.');
    }

    public function edit(Evidence $evidence)
    {
        return view('evidences.edit', compact('evidence'));
    }

    public function update(Request $request, Evidence $evidence)
    {
        $request->validate([
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'boolean'
        ]);

        $evidence->description = $request->description;
        $evidence->date = $request->date;
        $evidence->location = $request->location;
        $evidence->status = $request->has('status');

        if ($request->hasFile('photo')) {
            if ($evidence->photo) {
                Storage::disk('public')->delete($evidence->photo);
            }
            $photo = $request->file('photo');
            $photoPath = $photo->store('evidences', 'public');
            $evidence->photo = $photoPath;
        }

        $evidence->save();
        return redirect()->route('evidences.index')->with('success', 'Evidencia actualizada exitosamente.');
    }

    public function destroy(Evidence $evidence)
    {
        if ($evidence->photo) {
            Storage::disk('public')->delete($evidence->photo);
        }
        
        $evidence->delete();
        return redirect()->route('evidences.index')->with('success', 'Evidencia eliminada exitosamente.');
    }

    public function toggleStatus(Evidence $evidence)
    {
        $evidence->status = !$evidence->status;
        $evidence->save();
        
        return response()->json([
            'success' => true,
            'status' => $evidence->status
        ]);
    }
}
