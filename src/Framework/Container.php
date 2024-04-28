<?php

namespace Framework;

use Closure;
use ReflectionClass;
use ReflectionException;

class Container
{
    private array $registry = [];

    public function set(string $name, Closure $closure): void
    {
        $this->registry[$name] = $closure;
    }

    /**
     * @throws ReflectionException
     */
    public function get(string $className): object
    {
        if (isset($this->registry[$className])) {
            return $this->registry[$className]();
        }

        $controllerReflection = new ReflectionClass($className);
        $constructor = $controllerReflection->getConstructor();

        $dependencies = [];

        if (is_null($constructor)) {
            return new $className;
        }
        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType();
            if (is_null($type)) {
                exit("Parameter '{$param->getName()}' of class $className has no type declaration");
            }

            if ($type->isBuiltin()) {
                exit("Failed to resolve constructor parameter '{$param->getName()}' of type '{$type->getName()}' in class $className ");
            }
            $dependencies[] = $this->get($type);
        }

        return new $className(...$dependencies);
    }
}