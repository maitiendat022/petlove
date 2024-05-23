<?php

namespace App\Composers;

use App\Models\Carts;
use Illuminate\View\View;

class CartComposer
{
    protected $cart;

    /**
     * Create a new profile composer.
     */
    public function __construct(Carts $cart) {
        $this->cart = $cart;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('countProduct', $this->countProduct());
    }
    public function countProduct(){
        if(auth()->check()){
            $cart = $this->cart->get(auth()->user()->id);
            return $cart ? $cart->cartProduct->count() : 0;
        }
    }
}
