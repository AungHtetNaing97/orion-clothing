<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use Livewire\Component;
use App\Models\Subcategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class HomeComponent extends Component
{
    public $sliders, $fproducts, $tproducts, $nproducts, $subcategories, $brands;

    public function mount($sliders, $fproducts, $tproducts, $nproducts, $subcategories, $brands) {
        $this->sliders = $sliders;
        $this->fproducts = $fproducts;
        $this->tproducts = $tproducts;
        $this->nproducts = $nproducts;
        $this->subcategories = $subcategories;
        $this->brands = $brands;
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
        return view('livewire.frontend.home-component', [
            'sliders' => $this->sliders,
            'fproducts' => $this->fproducts,
            'tproducts' => $this->tproducts,
            'nproducts' => $this->nproducts,
            'subcategories' => $this->subcategories,
            'brands' => $this->brands
        ]);
    }
}
