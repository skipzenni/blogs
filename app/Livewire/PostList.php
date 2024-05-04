<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';
    #[Url()]
    public $popular = false;

    public function setSort($sort){
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }

    #[On('search')]
    public function updatedSearch($search){
        $this->search = $search;
    }
    #[Computed()]
    public function posts()
    {
        // dd(Category::where('slug', $this->category)->first());
        // simplePagine(3)
        return Post::published()
        ->with('author','categories')
        ->when($this->activeCategory, function ($query) {
            $query->withCategory($this->category);
        })
        ->when($this->popular, function ($query) {
            $query->popular();
        })
        // ->whereHas('categories', function ($query) {
        //     $query->where('slug', $this->category);
        // })
        ->search($this->search)
        ->orderBy('published_at', $this->sort)
        ->paginate(3);
    }

    public function clearFilters(){
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }
    #[Computed()]
    public function activeCategory(){
        if($this->category === '' || $this->category === null){
            return null;
        }
        return Category::where('slug', $this->category)->first();
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
