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
    protected $formOptions;

    /**
     * @var array
     */
    protected $settings = array();

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
     * @param Config $config
     * @param \Illuminate\Html\FormBuilder $formBuilder
     */
    function __construct(Validator $validator, Config $config, FormBuilder $formBuilder) {
        $this->validator = $validator;
        $this->builder = $formBuilder;
        $configSettings = $config->get('form-magic::settings');
        $this->settings = array_merge($configSettings, $this->settings); // don't forget: later value in array_merge overwrites earlier.
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
            $rules[$field] = $properties['rules'];
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