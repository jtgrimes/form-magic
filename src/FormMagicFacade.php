<?php  namespace Jtgrimes\FormMagic;


use Illuminate\Support\Facades\Facade;

class FormMagicFacade extends Facade{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'form-magic'; }

} 