<?php

/**
 * @author awt <awt@binarylab.io>
 */

namespace App\Traits;

use BadMethodCallException;

/**
 * Resolves underlying models by using php magic methods
 */
trait DelegatesToModels
{
    /**
     * Return underlying model attributes
     * @param mixed $name
     */
    public function __get($name)
    {
        return $this->model->{$name};
    }
    /**
     * Call underlying model methods
     *
     * @param mixed $name
     * @param mixeds $parameters
     * @return void
     */
    public function __call($name, $parameters)
    {
        try {
            return $this->model->{$name}(...$parameters);
        } catch (BadMethodCallException $x) {
            report($x);
        }
    }
}
