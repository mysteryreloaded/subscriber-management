<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldStoreRequest;
use App\Http\Requests\FieldUpdateRequest;
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

    public function store(FieldStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        (new Field())->fill($data)->save();

        return response()->json(['success' => true]);
    }

    public function update(FieldUpdateRequest $request, Field $field): JsonResponse
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
