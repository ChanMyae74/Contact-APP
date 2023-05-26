<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PhoneCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $contact, $showLink, $showAction;
    public function __construct($contact, $showLink, $showAction)
    {
        $this->contact = $contact;
        $this->showLink = $showLink;
        $this->showAction = $showAction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.phone-card');
    }
}
