<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ShowField extends Component
{
    public $label;
    public $class;
    public $colClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = '', $class = '', $colClass = '')
    {
        $this->label = $label;
        $this->class = $class;
        $this->colClass = $colClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.show-field');
    }
}
