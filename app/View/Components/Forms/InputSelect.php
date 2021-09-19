<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputSelect extends Component
{
    public $name;
    public $label;
    public $id;
    public $groupClass;
    public $class;
    public $value;
    public $helpText;

    public $required;
    public $useId;

    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = '', $id = '', $groupClass = 'col-12', $class = '', $value = '', $helpText = '', $required = false, $useId = true, $options = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = ( $id == '' ? $name : $id );
        $this->groupClass = $groupClass;
        $this->class = $class;
        $this->value = $value;
        $this->helpText = $helpText;

        $this->required = ( $required == "true" || $required == "1" || $required === true ? true : false );
        $this->useId = ( $useId == "true" || $useId == "1" || $useId === true ? true : false );

        if ( is_array( $options ) ) {
            $this->options = $options;
        } else {
            $this->options = json_decode( html_entity_decode($options), true );
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-select');
    }

    public function isSelected($option) {
        return $option == $this->value;
    }
}
