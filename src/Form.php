<?php  namespace Jtgrimes\FormMagic;

use Illuminate\Config\Repository as Config;
use Illuminate\Html\FormBuilder;
use Illuminate\Validation\Factory as Validator;

/**
 * Class Form
 * @package Jtgrimes\FormMagic
 */
abstract class Form {

    /**
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;
    /**
     * @var \Illuminate\Validation\Validator
     */
    protected $validation;
    /**
     * @var array
     */
    protected $fields;

    /**
     * @var array
     */
    protected $formOptions = array(
        "method"=>"post",
        "url"=>"#",
    );

    /**
     * @var array
     */
    protected $settings = array(
        /*
        |--------------------------------------------------------------------------
        | Wrapper
        |--------------------------------------------------------------------------
        |
        | By default, each form element will be wrapped within this element
        |
        */
        'wrapper' => 'div',

        /*
        |--------------------------------------------------------------------------
        | Wrapper Class
        |--------------------------------------------------------------------------
        |
        | By default, the wrapper element will get the following class
        |
        */
        'wrapperClass' => 'control-group',

        /*
        |--------------------------------------------------------------------------
        | Input Class
        |--------------------------------------------------------------------------
        |
        | By default, form inputs will get the following class
        |
        */
        'inputClass' => 'form-control',

        /*
        |--------------------------------------------------------------------------
        | Label Class
        |--------------------------------------------------------------------------
        |
        | By default, form labels will get the following class
        |
        */
        'labelClass' => 'control-label',
    );

    /**
     * @var \Illuminate\Html\FormBuilder
     */
    protected $builder;

    /**
     * @var FormFieldBuilder
     */
    protected $fieldBuilder;

    /**
     * @param Validator $validator
     * @param \Illuminate\Html\FormBuilder $formBuilder
     */
    function __construct(Validator $validator, FormBuilder $formBuilder) {
        $this->validator = $validator;
        $this->builder = $formBuilder;
        $this->fieldBuilder = new FormFieldBuilder($this->settings,$formBuilder);
    }

    /**
     *
     */
    public function render() {
        $returnString=$this->builder->open($this->formOptions);
        foreach ($this->fields as $field=>$properties) {
            unset($properties['rule']); // this isn't part of building...yet
            $returnString.= $this->fieldBuilder->make($field,$properties);
        }
        $returnString.=$this->builder->close();
        return $returnString;
    }

    /**
     * @param array $formData
     * @return bool
     */
    public function validate(array $formData) {
        $this->validation = $this->validator->make($formData, $this->getValidationRules());
        return $this->validation->passes();
    }

    /**
     * @return array
     */
    protected function getValidationRules() {
        $rules = array();
        foreach ($this->fields as $field=>$properties) {
            $rules[$field] = array_get($properties,'rules',"");
        }
        return $rules;
    }

    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function errors() {
        return $this->validation->errors();
    }
}