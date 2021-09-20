<?php

namespace App\View\Components\Views;

use Illuminate\View\Component;

class EditView extends Component
{
    public $title;
    public $titleSingular;
    public $object;
    public $objectSingular;
    public $model;
    public $ref;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $titleSingular, $object, $objectSingular, $model = null, $ref = '')
    {
        $this->title = $title;
        $this->titleSingular = $titleSingular;
        $this->object = $object;
        $this->objectSingular = $objectSingular;
        $this->model = $model;
        $this->ref = $ref;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.views.edit-view');
    }
}
