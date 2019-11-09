<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/28/19
 * Time: 7:39 PM
 */

namespace App\Actions\Property;

use App\Property;

class FindProperty
{
    public function execute($id = null)
    {
        return  is_null($id) ? $this->findAll() : $this->findById($id);
    }

    private function findAll()
    {
        return Property::with('images')->published()->get();
    }

    private function findById($id)
    {
        return Property::with('images')->findOrFail($id);
    }
}