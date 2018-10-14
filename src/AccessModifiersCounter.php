<?php
/**
 * Class that keep count data
 * count of public, protected,
 * private access modifiers
 *
 * @author Sergey R <qwe@qwe.com>
 */

namespace App;

class AccessModifiersCounter
{
    private $public = 0;
    private $protected = 0;
    private $private = 0;

    public function incrementPublic(): void
    {
        ++$this->public;
    }

    public function incrementProtected(): void
    {
        ++$this->protected;
    }

    public function incrementPrivate(): void
    {
        ++$this->private;
    }

    public function getPublicCount(): int
    {
        return $this->public;
    }

    public function getProtectedCount(): int
    {
        return $this->protected;
    }

    public function getPrivateCount(): int
    {
        return $this->private;
    }

    /**
     * returns count of counted
     * requested access modifier
     *
     * @param $name
     *
     * @return int
     */
    public function __get($name):int
    {
        $name = ucfirst($name);
        $method = "get{$name}Count";

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return null;
    }

    public function __isset($name)
    {
        $name = ucfirst($name);
        $method = "get{$name}Count";

        return method_exists($this, $method);
    }
}
