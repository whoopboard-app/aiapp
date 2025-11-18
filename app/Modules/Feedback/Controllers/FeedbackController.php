<?php

namespace App\Modules\Feedback\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of feedback items
     */
    public function index()
    {
        return view('feedback.index');
    }
    
    /**
     * Show the form for creating new feedback
     */
    public function create()
    {
        return view('feedback.create');
    }
    
    /**
     * Store a newly created feedback item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:bug,feature,improvement',
            'priority' => 'nullable|in:low,medium,high',
        ]);
        
        // TODO: Create feedback model and store
        // $feedback = auth()->user()->feedback()->create($validated);
        
        return redirect()->route('feedback.index')
            ->with('success', 'Feedback created successfully.');
    }
    
    /**
     * Display the specified feedback item
     */
    public function show($id)
    {
        // TODO: Load feedback model
        return view('feedback.show', compact('id'));
    }
    
    /**
     * Show the form for editing feedback
     */
    public function edit($id)
    {
        // TODO: Load feedback model
        return view('feedback.edit', compact('id'));
    }
    
    /**
     * Update the specified feedback item
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:bug,feature,improvement',
            'priority' => 'nullable|in:low,medium,high',
        ]);
        
        // TODO: Update feedback model
        
        return redirect()->route('feedback.show', $id)
            ->with('success', 'Feedback updated successfully.');
    }
    
    /**
     * Remove the specified feedback item
     */
    public function destroy($id)
    {
        // TODO: Delete feedback model
        
        return redirect()->route('feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}
