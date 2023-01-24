<?php

namespace tests\dev\mock\classes;

use \Closure;
use \tests\dev\mock\classes\ClassBExtendsClassA;

/**
 * The ClassCExtendsClassBInheirtsFromClassA class mocks a base class that will be
 * extended by other classes.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ClassCExtendsClassBInheirtsFromClassA extends ClassBExtendsClassA
{
    private bool $classCExtendsClassBInheirtsFromClassAPrivateProperty = true;
    protected bool $classCExtendsClassBInheirtsFromClassAProtectedProperty = false;
    public bool $classCExtendsClassBInheirtsFromClassAPublicProperty = true;
    private static bool $classCExtendsClassBInheirtsFromClassAPrivateStaticProperty = true;
    protected static bool $classCExtendsClassBInheirtsFromClassAProtectedStaticProperty = false;
    public static bool $classCExtendsClassBInheirtsFromClassAPublicStaticProperty = true;
    private bool $privatePropertySharedName = true;
    protected bool $protectedPropertySharedName = true;
    public bool $publicPropertySharedName = true;
    private static bool $privateStaticPropertySharedName = true;
    protected static bool $protectedStaticPropertySharedName = true;
    public static bool $publicStaticPropertySharedName = true;

    private function classCExtendsClassBInheirtsFromClassAPrivateMethod(): bool
    {
        if($this->privatePropertySharedName) {
            return $this->classCExtendsClassBInheirtsFromClassAPrivateProperty;
        }
        return false;
    }

    private static function classCExtendsClassBInheirtsFromClassAPrivateStaticMethod(): bool
    {
        if(self::$privateStaticPropertySharedName) {
            return self::$classCExtendsClassBInheirtsFromClassAPrivateStaticProperty;
        }
        return false;
    }

    protected function classCExtendsClassBInheirtsFromClassAProtectedMethod(): void
    {
        $this->classCExtendsClassBInheirtsFromClassAPrivateMethod();
    }

    protected static function classCExtendsClassBInheirtsFromClassAProtectedStaticMethod(): void
    {
        self::classCExtendsClassBInheirtsFromClassAPrivateStaticMethod();
    }

    public function classCExtendsClassBInheirtsFromClassAPublicMethod(): void
    {
        $this->classCExtendsClassBInheirtsFromClassAProtectedMethod();
    }

    public static function classCExtendsClassBInheirtsFromClassAPublicStaticMethod(): void
    {
        self::classCExtendsClassBInheirtsFromClassAProtectedStaticMethod();
    }

    final protected function classCExtendsClassBInheirtsFromClassAFinalProtectedMethod(): void
    {
        $this->classCExtendsClassBInheirtsFromClassAPrivateMethod();
    }

    final protected static function classCExtendsClassBInheirtsFromClassAFinalProtectedStaticMethod(): void
    {
        self::classCExtendsClassBInheirtsFromClassAPrivateStaticMethod();
    }

    final public function classCExtendsClassBInheirtsFromClassAFinalPublicMethod(): void
    {
        $this->classCExtendsClassBInheirtsFromClassAFinalProtectedMethod();
    }

    final public static function classCExtendsClassBInheirtsFromClassAFinalPublicStaticMethod(): void
    {
        self::classCExtendsClassBInheirtsFromClassAFinalProtectedStaticMethod();
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

    final protected function finalProtectedMethodClassC(): void
    {
        $this->privateMethodSharedName();
    }

    final protected function finalProtectedStaticMethodClassC(): void
    {
        self::privateStaticMethodSharedName();
    }

    final public function finalPublicMethodClassC(): void {}

    final public static function finalPublicStaticMethodClassC(): void {}

}
