<?php

namespace App\View\Components;

use Illuminate\View\Component;

class guestcart extends Component
{

    public $cartItems;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cartItems)
    {
        $this->cartItems = $cartItems;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.guestcart');
    }
}
