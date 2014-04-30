<?php namespace Jtgrimes\FormMagic;


use Illuminate\Support\ServiceProvider;

class FormMagicServiceProvider extends ServiceProvider {

    public function register() {
        $this->package('jtgrimes/form-magic');
    }

} 