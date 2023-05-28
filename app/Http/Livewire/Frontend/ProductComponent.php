<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class ProductComponent extends Component
{
    public $subcategory;

    public function mount($subcategory) {
        $this->subcategory = $subcategory;
    }

    public function addToWishlist($productId) {
        if(Auth::check()) {
            if(Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                $this->dispatchBrowserEvent('warning', [
                    'text' => 'Already added to wishlist!'
                ]);
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedRemoved');
                $this->dispatchBrowserEvent('success', [
                    'text' => 'Added to wishlist successfully'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('info', [
                'text' => 'Please login to add to wishlist'
            ]);
            return false;
        }
    }

    public function render()
    {
        $products = Product::where('status', 0)
                            ->where('category_id', $this->subcategory->category->id)
                            ->where('subcategory_id', $this->subcategory->id)
                            ->orderBy('created_at', 'DESC')->paginate(6);

        return view('livewire.frontend.product-component', [
            'subcategory' => $this->subcategory,
            'products' => $products
        ]);
    }
}
