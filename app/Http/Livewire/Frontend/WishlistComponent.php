<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistComponent extends Component
{
    public function removeFromWishlist($wishlistId) {
        Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->delete();
        $this->emit('wishlistAddedRemoved');
        $this->dispatchBrowserEvent('success', [
            'text' => 'Removed from Wishlist!'
        ]);
    }

    public function render()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->paginate(6);
        return view('livewire.frontend.wishlist-component', [
            'wishlists' => $wishlists
        ]);
    }
}
