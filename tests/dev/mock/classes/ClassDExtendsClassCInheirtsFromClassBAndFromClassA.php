<?php

namespace tests\dev\mock\classes;

use \Closure;
use \tests\dev\mock\classes\ClassCExtendsClassBInheirtsFromClassA;

# ClassCExtendsClassBInheirtsFromClassA
/**
 * The ClassDExtendsClassCInheirtsFromClassBAndFromClassA class mocks a base class that will be
 * extended by other classes.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ClassDExtendsClassCInheirtsFromClassBAndFromClassA extends ClassCExtendsClassBInheirtsFromClassA
{
    private bool $classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateProperty = true;
    protected bool $classDExtendsClassCInheirtsFromClassBAndFromClassAProtectedProperty = false;
    public int|bool|null $classDExtendsClassCInheirtsFromClassBAndFromClassAPublicProperty = null;
    private static int|bool|null $classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateStaticProperty = true;
    protected static bool $classDExtendsClassCInheirtsFromClassBAndFromClassAProtectedStaticProperty = false;
    public static bool $classDExtendsClassCInheirtsFromClassBAndFromClassAPublicStaticProperty = true;
    private bool $privatePropertySharedName = true;
    protected bool $protectedPropertySharedName = true;
    public bool $publicPropertySharedName = true;
    private static bool $privateStaticPropertySharedName = true;
    protected static bool $protectedStaticPropertySharedName = true;
    public static bool $publicStaticPropertySharedName = true;

    private function classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateMethod(): bool
    {
        if($this->privatePropertySharedName) {
            return $this->classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateProperty;
        }
        return false;
    }

    private static function classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateStaticMethod(): int|bool|null
    {
        if(self::$privateStaticPropertySharedName) {
            return self::$classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateStaticProperty;
        }
        return false;
    }

    protected function classDExtendsClassCInheirtsFromClassBAndFromClassAProtectedMethod(): void
    {
        $this->classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateMethod();
    }

    protected static function classDExtendsClassCInheirtsFromClassBAndFromClassAProtectedStaticMethod(): void
    {
        self::classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateStaticMethod();
    }

    public function classDExtendsClassCInheirtsFromClassBAndFromClassAPublicMethod(): void
    {
        $this->classDExtendsClassCInheirtsFromClassBAndFromClassAProtectedMethod();
    }

    public static function classDExtendsClassCInheirtsFromClassBAndFromClassAPublicStaticMethod(): void
    {
        self::classDExtendsClassCInheirtsFromClassBAndFromClassAProtectedStaticMethod();
    }

    final protected function classDExtendsClassCInheirtsFromClassBAndFromClassAFinalProtectedMethod(): void
    {
        $this->classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateMethod();
    }

    final protected static function classDExtendsClassCInheirtsFromClassBAndFromClassAFinalProtectedStaticMethod(): void
    {
        self::classDExtendsClassCInheirtsFromClassBAndFromClassAPrivateStaticMethod();
    }

    final public function classDExtendsClassCInheirtsFromClassBAndFromClassAFinalPublicMethod(): void
    {
        $this->classDExtendsClassCInheirtsFromClassBAndFromClassAFinalProtectedMethod();
    }

    final public static function classDExtendsClassCInheirtsFromClassBAndFromClassAFinalPublicStaticMethod(): void
    {
        self::classDExtendsClassCInheirtsFromClassBAndFromClassAFinalProtectedStaticMethod();
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

    final protected function finalProtectedMethodClassD(): void
    {
        $this->privateMethodSharedName();
    }

    final protected function finalProtectedStaticMethodClassD(): void
    {
        self::privateStaticMethodSharedName();
    }

    final public function finalPublicMethodClassD(): void {}

    final public static function finalPublicStaticMethodClassD(): void {}

}
