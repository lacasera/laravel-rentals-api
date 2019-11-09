<?php

namespace App\Exceptions;

use Exception;

class PropertyBookedException extends Exception
{

    public function report()
    {

    }

    public function render()
    {
        return response()->json([
            'status' => 'error',
            'results' => 'property already booked'
        ], 400);
    }
}
