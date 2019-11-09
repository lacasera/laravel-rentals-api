<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/28/19
 * Time: 1:37 PM
 */
namespace App\Actions\Property;

class PublishProperty
{
    private $findProperty;

    public function __construct(FindProperty $findProperty)
    {
        $this->findProperty = $findProperty;
    }

    public function execute(string $currentState, $id)
    {
         $property = $this->findProperty->execute($id);

          $currentState === 'published' ? $property->unpublish() : $property->publish();

          return $this->findProperty->execute($id);
    }
}