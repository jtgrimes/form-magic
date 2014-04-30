<?php  namespace Jtgrimes\FormMagic;
use Illuminate\Validation\Factory as Validator;


abstract class Form {

    protected $validator;
    protected $validation;

    function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    public function render() {
        //TODO implement Form.render()
    }
    public function validate(array $formData) {
        $this->validation = $this->validator->make($formData, $this->getValidationRules());
        return $this->validation->passes();
    }

    protected function getValidationRules() {
        foreach ($this->fields as $field=>$properties) {
            $rules[$field] = $properties['rules'];
        }
        return $rules;
    }

    public function errors() {
        return $this->validation->errors();
    }
}