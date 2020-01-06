<?php

namespace DarlingCms\interfaces\utility;

interface ReflectionUtility
{
    public function getClassPropertyNames($class): array;

    public function getClassPropertyTypes($class): array;

    public function getClassPropertyValues($class): array;

    public function getClassInstance($class, array $constructorArguments = array());

    public function getClassMethodParameterNames($class, string $method): array;

    public function getClassMethodParameterTypes($class, string $method): array;

    public function generateMockClassMethodArguments($class, string $method): array;
}
