<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RowActions extends Component
{
    public $object;
    public $objectSingular;
    public $model;
    public $title;
    public $ref;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($object, $objectSingular, $model, $title, $ref)
    {
        $this->object = $object;
        $this->objectSingular = $objectSingular;
        $this->model = $model;
        $this->title = $title;
        $this->ref = $ref;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-actions');
    }
}
