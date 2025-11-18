<?php

namespace App\Livewire\Feedback;

use Livewire\Component;
use Livewire\WithPagination;

class FeedbackList extends Component
{
    use WithPagination;
    
    public $search = '';
    public $category = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        // TODO: Replace with actual model query
        // $feedback = Feedback::query()
        //     ->when($this->search, fn($q) => $q->search($this->search))
        //     ->when($this->category, fn($q) => $q->where('category', $this->category))
        //     ->orderBy($this->sortBy, $this->sortDirection)
        //     ->paginate(15);
        
        $feedback = collect(); // Placeholder
        
        return view('livewire.feedback.feedback-list', [
            'feedback' => $feedback
        ]);
    }
}
