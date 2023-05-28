<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
{
    use WithPagination;

    public $allproducts, $categories, $subcategories, $nproducts, $orderBy = "Latest";

    public function mount($allproducts, $categories, $subcategories, $nproducts) {
        $this->allproducts = $allproducts;
        $this->categories = $categories;
        $this->subcategories = $subcategories;
        $this->nproducts = $nproducts;
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

    public function changeOrderBy($order) {
        $this->orderBy = $order;
    }

    public function render()
    {
        if($this->orderBy == 'Price: Low to High') {
            $products = Product::where('status', 0)
                        ->orderBy('regular_price', 'ASC')
                        ->orderBy('sale_price', 'ASC')->paginate(9);
        } elseif($this->orderBy == 'Price: High to Low') {
            $products = Product::where('status', 0)
                        ->orderBy('regular_price', 'DESC')
                        ->orderBy('sale_price', 'DESC')->paginate(9);
        } else {
            $products = Product::where('status', 0)
                        ->orderBy('created_at', 'DESC')->paginate(9);
        }

        return view('livewire.frontend.shop-component', [
            'allproducts' => $this->allproducts,
            'products' => $products,
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'nproducts' => $this->nproducts
        ]);
    }
}
