<?php namespace Jtgrimes\FormMagic;

use Illuminate\Html\FormBuilder;

class FormFieldBuilder {

    protected $wrapper;
    protected $wrapperClass;
    protected $inputClass;
    protected $labelClass;
    protected $f;


    public function __construct(array $settings, FormBuilder $formBuilder) {
        $this->wrapper = $settings['wrapper'];
        $this->wrapperClass = $settings['wrapperClass'];
        $this->inputClass = $settings['inputClass'];
        $this->labelClass = $settings['labelClass'];
        $this->f = $formBuilder;
    }


    public function make($name,array $args) {
        // gotta love Laravel's array_get -- get if exists, else return default.
        $wrapper = array_get($args,'wrapper',$this->wrapper);
        $wrapperClass = array_get($args,'wrapperClass',$this->wrapperClass);

        $field = $this->createField($name, $args);

        return "<$wrapper class=\"$wrapperClass\">$field</$wrapper>\n";

    }

    public function createField($name, array $args) {
        $type = array_get($args, 'type','text');

        // if there's a class in the args, use that, else use default
        $args = array_merge(['class' => $this->inputClass], $args);

        $labelHTML = $this->createLabel($name, $args);

        unset($args['label']);

        return $labelHTML . $this->createInput($type, $name, $args);
    }

    protected function createLabel($name, array $args) {
        $label = array_get($args, 'label',$this->prettifyFieldName($name).': ');
        $labelClass = array_get($args,'labelClass',$this->labelClass);

        return $this->f->label($name, $label, array('class' => $labelClass));
    }

    protected function createInput($type, $name, array $args) {
        return $type == 'password'
            ? $this->f->password($name, $args)
            : $this->f->$type($name, null, $args);    }

    protected function prettifyFieldName($name) {
        return ucwords(preg_replace('/(?<=\w)(?=[A-Z])/', " $1", $name));
    }


} 