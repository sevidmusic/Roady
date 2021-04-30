<?php

namespace DarlingDataManagementSystem\interfaces\utility;

use ReflectionClass;

interface ReflectionUtility
{
    /**
     * @param class-string<object>|object $class
     * @return array<int, string>
     */
    public function getClassPropertyNames(string|object $class): array;

    /**
     * @param class-string<object>|object $class
     * @return array<int|string, string>
     */
    public function getClassPropertyTypes(string|object $class): array;

    /**
     * @param class-string<object>|object $class
     * @return array<mixed>
     */
    public function getClassPropertyValues(string|object $class): array;

    /**
     * @param class-string<object>|object $class
     * @param array<mixed> $constructorArguments
     * @return object
     */
    public function getClassInstance(string|object $class, array $constructorArguments = array());

    /**
     * @param class-string<object>|object $class
     * @return array<int, string>
     */
    public function getClassMethodParameterNames(string|object $class, string $method): array;

    /**
     * @param class-string<object>|object $class
     * @return array<int, string>
     */
    public function getClassMethodParameterTypes(string|object $class, string $method): array;

    /**
     * @param class-string<object>|object $class
     * @param string $method
     * @return array<mixed>
     */
    public function generateMockClassMethodArguments(string|object $class, string $method): array;

    /**
     * @param class-string<object>|object $class
     * @return ReflectionClass<object>
     */
    public function getClassReflection(string|object $class): ReflectionClass;
}
