<?php  namespace Jtgrimes\FormMagic;

use Illuminate\Html\FormBuilder;
use Illuminate\Validation\Validator;
use Illuminate\Config\Repository;

class FormMagic {

    private $forms;

    private $config;
    private $builder;
    private $validator;

    public function __construct($config,$builder,$validator) {
        $this->config = $config;
        $this->builder = $builder;
        $this->validator = $validator;
        $this->loadForms();
    }

    private function loadForms() {

    }

    public function validate($name,$args) {
        
    }

    public function render($name) {

    }
} 