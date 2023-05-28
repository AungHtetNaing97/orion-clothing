<?php

namespace App\Http\Livewire\Frontend;

use session;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Variant;
use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class DetailsComponent extends Component
{
    public $product, $variants, $rproducts, $subcategories, $nproducts, $variantId, $quantityCount = 1;

    public function mount($product, $variants, $rproducts, $subcategories, $nproducts) {
        $this->product = $product;
        $this->variants = $variants;
        $this->rproducts = $rproducts;
        $this->subcategories = $subcategories;
        $this->nproducts = $nproducts;
    }

    public function variantSelected($variantId) {
        $this->variantId = $variantId;
    }

    public function decrementQuantity() {
        $this->quantityCount--;
    }
    public function incrementQuantity() {
        $this->quantityCount++;
    }

    public function addToCart() {
        if(Auth::check()) {
            if (empty($this->variantId)) {
                $this->dispatchBrowserEvent('info', [
                    'text' => 'Please choose color and size first!'
                ]);
            } else {
                $chosenVariant = Variant::where('status', 0)->where('id', $this->variantId)->first();
                if(Cart::where('user_id', auth()->user()->id)->where('variant_id', $chosenVariant->id)->exists()) {
                    $this->dispatchBrowserEvent('warning', [
                        'text' => 'Already added to cart!'
                    ]);
                } else {
                    if($chosenVariant->quantity > 0) {
                        if($chosenVariant->quantity >= $this->quantityCount) {
                            // Insert Product to Cart
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'variant_id' => $chosenVariant->id,
                                'quantity' => $this->quantityCount
                            ]);
                            $this->emit('cartAddedRemoved');
                            $this->dispatchBrowserEvent('success', [
                                'text' => 'Added to cart successfully!'
                            ]);
                        } else {
                            $this->dispatchBrowserEvent('info', [
                                'text' => 'Only ' . $chosenVariant->quantity . ' Quantity Available!'
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('danger', [
                            'text' => 'Out of Stock'
                        ]);
                    }
                }
            }
        } else {
            $this->dispatchBrowserEvent('info', [
                'text' => 'Please login to add to cart'
            ]);
        }
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
        return view('livewire.frontend.details-component', [
            'product' => $this->product,
            'variants' => $this->variants,
            'rproducts' => $this->rproducts,
            'subcategories' => $this->subcategories,
            'nproducts' => $this->nproducts
        ]);
    }
}
