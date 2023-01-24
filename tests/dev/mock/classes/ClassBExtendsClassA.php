<?php

namespace tests\dev\mock\classes;

use \Closure;
use \tests\dev\mock\classes\ClassABaseClass;

/**
 * The ClassBExtendsClassA class mocks a base class that will be
 * extended by other classes.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ClassBExtendsClassA extends ClassABaseClass
{
    private bool $classBExtendsClassAPrivateProperty = true;
    protected bool $classBExtendsClassAProtectedProperty = false;
    public bool $classBExtendsClassAPublicProperty = true;
    private static bool $classBExtendsClassAPrivateStaticProperty = true;
    protected static bool $classBExtendsClassAProtectedStaticProperty = false;
    public static bool $classBExtendsClassAPublicStaticProperty = true;
    private bool $privatePropertySharedName = true;
    protected bool $protectedPropertySharedName = true;
    public bool $publicPropertySharedName = true;
    private static bool $privateStaticPropertySharedName = true;
    protected static bool $protectedStaticPropertySharedName = true;
    public static bool $publicStaticPropertySharedName = true;

    private function classBExtendsClassAPrivateMethod(): bool
    {
        if($this->privatePropertySharedName) {
            return $this->classBExtendsClassAPrivateProperty;
        }
        return false;
    }

    private static function classBExtendsClassAPrivateStaticMethod(): bool
    {
        if(self::$privateStaticPropertySharedName) {
            return self::$classBExtendsClassAPrivateStaticProperty;
        }
        return false;
    }

    protected function classBExtendsClassAProtectedMethod(): void
    {
        $this->classBExtendsClassAPrivateMethod();
    }

    protected static function classBExtendsClassAProtectedStaticMethod(): void
    {
        self::classBExtendsClassAPrivateStaticMethod();
    }

    public function classBExtendsClassAPublicMethod(): void
    {
        $this->classBExtendsClassAProtectedMethod();
    }

    public static function classBExtendsClassAPublicStaticMethod(): void
    {
        self::classBExtendsClassAProtectedStaticMethod();
    }

    final protected function classBExtendsClassAFinalProtectedMethod(): void
    {
        $this->classBExtendsClassAPrivateMethod();
    }

    final protected static function classBExtendsClassAFinalProtectedStaticMethod(): void
    {
        self::classBExtendsClassAPrivateStaticMethod();
    }

    final public function classBExtendsClassAFinalPublicMethod(): void
    {
        $this->classBExtendsClassAFinalProtectedMethod();
    }

    final public static function classBExtendsClassAFinalPublicStaticMethod(): void
    {
        self::classBExtendsClassAFinalProtectedStaticMethod();
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

    public static function publicStaticMethodClassB(): void {}

    final protected function finalProtectedMethodClassB(): void
    {
        $this->privateMethodSharedName();
    }

    final protected function finalProtectedStaticMethodClassB(): void
    {
        self::privateStaticMethodSharedName();
    }

    final public function finalPublicMethodClassB(): void {}

    final public static function finalPublicStaticMethodSharedName(): void {}

}
