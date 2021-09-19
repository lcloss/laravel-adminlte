<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputText extends Component
{
    public $name;
    public $label;
    public $id;
    public $type;
    public $groupClass;
    public $class;
    public $value;
    public $placeholder;
    public $helpText;

    public $iconAppend;
    public $required;
    public $useId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = '', $id = '', $type = 'text', $groupClass = 'col-12', $class = '', $value = '', $placeholder = '', $helpText = '', $iconAppend = '', $required = false, $useId = true)
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = ( $id == '' ? $name : $id );
        $this->type = $type;
        $this->groupClass = $groupClass;
        $this->class = $class;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->helpText = $helpText;

        $this->iconAppend = $iconAppend;
        $this->required = ( $required == "true" || $required == "1" || $required === true ? true : false );
        $this->useId = ( $useId == "true" || $useId == "1" || $useId === true ? true : false );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-text');
    }
}
