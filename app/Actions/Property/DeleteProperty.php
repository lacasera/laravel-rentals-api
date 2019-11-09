<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/28/19
 * Time: 7:14 PM
 */
namespace App\Actions\Property;

class DeleteProperty
{
    private $findProperty;

    public function __construct(FindProperty $findProperty)
    {
        $this->findProperty = $findProperty;
    }

    public function execute($id): bool
    {
        $property = $this->findProperty->execute($id);

        return $property->delete();
    }
}