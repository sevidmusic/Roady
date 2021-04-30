<?php

namespace DarlingDataManagementSystem\interfaces\utility;

use ReflectionClass;

interface ReflectionUtility
{
    public function getClassPropertyNames(string|object $class): array;

    public function getClassPropertyTypes(string|object $class): array;

    public function getClassPropertyValues(string|object $class): array;

    public function getClassInstance(string|object $class, array $constructorArguments = array());

    public function getClassMethodParameterNames(string|object $class, string $method): array;

    public function getClassMethodParameterTypes(string|object $class, string $method): array;

    public function generateMockClassMethodArguments(string|object $class, string $method): array;

    public function getClassReflection(string|object $class): ReflectionClass;
}
