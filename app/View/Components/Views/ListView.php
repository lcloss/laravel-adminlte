<?php

namespace App\View\Components\Views;

use Illuminate\View\Component;

class ListView extends Component
{
    public $title;
    public $titleSingular;
    public $object;
    public $objectSingular;
    public $collection;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $titleSingular, $object, $objectSingular, $collection)
    {
        $this->title = $title;
        $this->titleSingular = $titleSingular;
        $this->object = $object;
        $this->objectSingular = $objectSingular;
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.views.list-view');
    }
}
