<?php
/**
 * Counts class data
 *
 * @author Sergey R <qwe@qwe.com>
 *
 */

namespace App;

class ClassInfo extends \ReflectionClass{

	/**
	 * Counts properties separated by types
	 *
	 * @return array counted data (public,protected,private)
	 */
	public function getPropertiesTypesCount(): array
	{

		$properties = [
			'public'    => 0,
			'protected' => 0,
			'private'   => 0,
		];

		foreach ($this->getProperties() as $prop){

			if($prop->isPublic()){
				++$properties['public'];
				continue;
			}

			if($prop->isProtected()){
				++$properties['protected'];
				continue;
			}

			if($prop->isPrivate ()){
				++$properties['private'];
				continue;
			}

		}

		return $properties;

	}

	/**
	 * Counts methods separated by types
	 *
	 * @return array counted data (public,protected,private)
	 */
	public function getMethodsTypesCount(): array
	{

		$methods = [
			'public'    => 0,
			'protected' => 0,
			'private'   => 0,
		];

		foreach ($this->getMethods() as $prop){

			if($prop->isPublic()){
				++$methods['public'];
				continue;
			}

			if($prop->isProtected()){
				++$methods['protected'];
				continue;
			}

			if($prop->isPrivate ()){
				++$methods['private'];
				continue;
			}

		}

		return $methods;
	}

	/**
	 * Returns class type
	 *
	 * @return string class type
	 *
	 */
	public function getClassType():string
	{

		return $this->isAbstract() ? "Abstract" : ( $this->isFinal() ? "Final" : "" );

	}
}