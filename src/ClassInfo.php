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
     * @return \App\TypesCount counted (properties/methods)
     *
     */
    private function countTypes(array $list): TypesCount
    {
        $counter = new TypesCount();

        foreach ($list as $prop) {
            if ($prop->isPublic()) {
                ++$counter->public;
                continue;
            }

            if ($prop->isProtected()) {
                ++$counter->protected;
                continue;
            }

            if ($prop->isPrivate()) {
                ++$counter->private;
                continue;
            }
        }

        return $counter;
    }

    /**
     * Counts properties separated by types
     *
     * @return \App\TypesCount counted data (public,protected,private)
     */
    public function getPropertiesTypesCount(): TypesCount
    {
        return $this->countTypes($this->getProperties());
    }

    /**
     * Counts methods separated by types
     *
     * @return \App\TypesCount counted data (public,protected,private)
     */
    public function getMethodsTypesCount(): TypesCount
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
