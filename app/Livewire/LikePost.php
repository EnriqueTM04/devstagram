<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    // se ejecuta cuando se instancia el componente
    public function mount($post) {
        $this->post = $post;
        $this->isLiked = $this->post->checkLike(Auth::user());
        $this->likes = $this->post->likes->count();
    }

    public function like() {
        // Ya habia like
        if($this->post->checkLike(Auth::user())) {
           Auth::user()->likes()->where('post_id', $this->post->id)->delete();
           $this->likes--;
           $this->isLiked = false;
        } else {
            $this->post->likes()->create([
                'user_id' => Auth::user()->id,
                'post_id' => $this->post->id
            ]);
            $this->likes++;
            $this->isLiked = true;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
