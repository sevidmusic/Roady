<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The ClassABaseClass class mocks a base class that will be
 * extended by other classes.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ClassABaseClass
{
    private bool $classABaseClassPrivateProperty = true;
    protected bool $classABaseClassProtectedProperty = false;
    public bool $classABaseClassPublicProperty = true;
    private static bool $classABaseClassPrivateStaticProperty = true;
    protected static bool $classABaseClassProtectedStaticProperty = false;
    public static bool $classABaseClassPublicStaticProperty = true;
    private bool $privatePropertySharedName = true;
    protected bool $protectedPropertySharedName = true;
    public bool $publicPropertySharedName = true;
    private static bool $privateStaticPropertySharedName = true;
    protected static bool $protectedStaticPropertySharedName = true;
    public static bool $publicStaticPropertySharedName = true;

    private function classABaseClassPrivateMethod(): bool
    {
        if($this->privatePropertySharedName) {
            return $this->classABaseClassPrivateProperty;
        }
        return false;
    }

    private static function classABaseClassPrivateStaticMethod(): bool
    {
        if(self::$privateStaticPropertySharedName) {
            return self::$classABaseClassPrivateStaticProperty;
        }
        return false;
    }

    protected function classABaseClassProtectedMethod(): void
    {
        $this->classABaseClassPrivateMethod();
    }

    protected static function classABaseClassProtectedStaticMethod(): void
    {
        self::classABaseClassPrivateStaticMethod();
    }

    public function classABaseClassPublicMethod(): void
    {
        $this->classABaseClassProtectedMethod();
    }

    public static function classABaseClassPublicStaticMethod(): void
    {
        self::classABaseClassProtectedStaticMethod();
    }

    final protected function classABaseClassFinalProtectedMethod(): void
    {
        $this->classABaseClassPrivateMethod();
    }

    final protected static function classABaseClassFinalProtectedStaticMethod(): void
    {
        self::classABaseClassPrivateStaticMethod();
    }

    final public function classABaseClassFinalPublicMethod(): void
    {
        $this->classABaseClassFinalProtectedMethod();
    }

    final public static function classABaseClassFinalPublicStaticMethod(): void
    {
        self::classABaseClassFinalProtectedStaticMethod();
    }

    private function privateMethodSharedName(): void {}

    private static function privateStaticMethodSharedName(): void {}

    protected function protectedMethodSharedName(): void
    {
        $this->privateMethodSharedName();
    }

    protected function protectedStaticMethodSharedName(): void
    {
        self::privateStaticMethodSharedName();
    }

    public function publicMethodSharedName(): void {}

    public static function publicStaticMethodSharedName(): void {}

}
