<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Actions\Property\{
    BookProperty,
    CreateProperty,
    DeleteProperty,
    FindProperty,
    PublishProperty, UpdateProperty
};

use App\Http\Requests\{
    AddPropertyRequest,
    BookPropertyRequest,
    UpdateStateRequest
};

class PropertyController extends Controller
{

    public function index(FindProperty $findProperty)
    {

        return response()->json([
            'status' => 'success',
            'results' =>  $findProperty->execute()
        ], 200);
    }


    public function store(AddPropertyRequest $request, CreateProperty $action)
    {
        $property = $action->execute($request->all());
        return response()->json([
            'status' => 'success',
            'results' =>  $property
        ], 201);
    }


    public function show(FindProperty $findProperty, $id)
    {
        $property = $findProperty->execute($id);

        return response()->json([
            'status' => 'success',
            'results' => $property
        ], 200);
    }


    public function update(Request $request, UpdateProperty $action, $id)
    {
        if ($property = $action->execute($request->except('images'), $id)) {
            return response()->json([
                'status' => 'success',
                'results' => $property
            ]);
        }
    }

    public function updateState(UpdateStateRequest $request, PublishProperty $action, $id)
    {
        $property = $action->execute($request->state, $id);
        return response()->json([
            'status' => 'success',
            'results' => $property
        ]);
    }


    public function destroy(DeleteProperty $action, $id)
    {
        if ($action->execute($id)) {
            return response()->json([], 204);
        }
    }

    public function book(BookPropertyRequest $request, BookProperty $action, $propertyId)
    {
        Gate::authorize('book-property', $propertyId);

        $action->execute(auth()->id(), $propertyId, $request->from, $request->to);

        return response()->json([
            'status' => 'success',
            'results' => "property booked successfully..."
        ], 200);

    }
}
