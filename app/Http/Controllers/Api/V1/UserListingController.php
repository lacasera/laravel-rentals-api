<?php

namespace App\Http\Controllers\Api\V1;

use App\Property;
use App\Http\Controllers\Controller;

class UserListingController extends Controller
{
    public function __invoke()
    {
        $userProperties = Property::with('images')
            ->where('user_id', auth()->id())
            ->get();

        return response()->json([
            'status' => 'success',
            'results' => $userProperties
        ]);
    }
}
