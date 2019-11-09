<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/28/19
 * Time: 7:26 PM
 */
namespace App\Actions\Property;

use App\Exceptions\PropertyBookedException;

class BookProperty
{
    private $findPropertyAction;

    public function __construct(FindProperty $findPropertyAction)
    {
        $this->findPropertyAction = $findPropertyAction;
    }

    public function execute($user, $property, $from, $to): bool
    {
        $property = $this->findPropertyAction->execute($property);

        if ($property->is_booked) {
            throw new PropertyBookedException();
        }

        return $property->book($from, $to, $user);
    }
}