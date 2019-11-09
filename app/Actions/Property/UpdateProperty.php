<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 11/1/19
 * Time: 5:10 PM
 */
namespace App\Actions\Property;

use App\Property;

class UpdateProperty
{
    protected $findPropertyAction;

    public function __construct(FindProperty $findPropertyAction)
    {
        $this->findPropertyAction = $findPropertyAction;
    }

    public function execute(array $data, int $id)
    {
        if (Property::where('id', $id)->update($data)) {
            return $this->findPropertyAction->execute($id);
        }
    }
}