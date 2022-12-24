<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Http\JsonResponse;

class FieldsController extends Controller
{
    public function index(): JsonResponse
    {
        $fields = Field::all();
        return response()->json(['success' => true, 'data' => FieldResource::collection($fields)]);
    }

    public function show(Field $field): JsonResponse
    {
        return response()->json(['success' => true, 'data' => new FieldResource($field)]);
    }

    public function store(FieldRequest $request): JsonResponse
    {
        $data = $request->validated();
        (new Field())->fill($data);

        return response()->json(['success' => true]);
    }

    public function update(FieldRequest $request, Field $field): JsonResponse
    {
        $data = $request->validated();
        $field->update($data);

        return response()->json(['success' => true]);
    }

    public function destroy(Field $field): JsonResponse
    {
        $field->delete();

        return response()->json(['success' => true]);
    }
}
