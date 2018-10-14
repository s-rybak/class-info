<?php
/**
 * Class that provide count of properties/methods
 * separated by types
 *
 *  @author Sergey R <qwe@qwe.com>
 */

namespace App;

class ClassInfo extends \ReflectionClass
{

    /**
     * Count properties/methods separated by types
     *
     * @param \ReflectionMethod[]|\ReflectionProperty[] $list
     *
     * @return \App\AccessModifiersCounter counted (properties/methods)
     *
     */
    private function countTypes(array $list): AccessModifiersCounter
    {
        $counter = new AccessModifiersCounter();

        foreach ($list as $prop) {
            if ($prop->isPublic()) {
                $counter->incrementPublic();
                continue;
            }

            if ($prop->isProtected()) {
                $counter->incrementProtected();
                continue;
            }

            if ($prop->isPrivate()) {
                $counter->incrementPrivate();
                continue;
            }
        }

        return $counter;
    }

    /**
     * Counts properties separated by types
     *
     * @return \App\AccessModifiersCounter counted data (public,protected,private)
     */
    public function getPropertiesTypesCount(): AccessModifiersCounter
    {
        return $this->countTypes($this->getProperties());
    }

    /**
     * Counts methods separated by types
     *
     * @return \App\AccessModifiersCounter counted data (public,protected,private)
     */
    public function getMethodsTypesCount(): AccessModifiersCounter
    {
        return $this->countTypes($this->getMethods());
    }

    /**
     * Returns class type
     *
     * @return string class type
     *
     */
    public function getClassType(): string
    {
        return $this->isAbstract() ? 'Abstract' : ($this->isFinal() ? 'Final' : '');
    }
}
