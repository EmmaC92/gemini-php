<?php

declare(strict_types=1);

namespace Emmac\Hello\Framework;

use ReflectionClass, ReflectionNamedType;
use Emmac\Hello\Framework\Exceptions\ContainerException;

class Container
{
    public function __construct(
        private array $definitions,
        private array $resolved = [],
    ) {
    }

    public function setDefinitions(array $definitions): void
    {
        $this->definitions = array_merge($this->definitions, $definitions);
    }

    public function resolve(string $controllerClass): mixed
    {
        $controller = new ReflectionClass($controllerClass);

        if (!$controller->isInstantiable()) {
            throw new ContainerException('This class is not instantiable');
        }

        $constructor = $controller->getConstructor();

        if (is_null($constructor)) {
            return new $controllerClass;
        }

        $params = $constructor->getParameters();

        if (count($params) == 0) {
            return new $controllerClass;
        }

        $dependencies = [];

        foreach ($params as $param) {

            $type = $param->getType();
            $name = $param->getName();

            if (!($type instanceof ReflectionNamedType) || $type->isBuiltin()) {
                throw new ContainerException("Parameter {$name} is not a valid parameter.");
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $controller->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} is not exist in the container.");
        }

        $factory = $this->definitions[$id];
        $dependency = $factory($this);

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}
