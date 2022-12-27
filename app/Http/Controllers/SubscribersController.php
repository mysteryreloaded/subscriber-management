<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberStoreRequest;
use App\Http\Requests\SubscriberUpdateRequest;
use App\Http\Resources\SubscriberResource;
use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;

class SubscribersController extends Controller
{
    public function index(): JsonResponse
    {
        $subscribers = Subscriber::all();
        return response()->json(['success' => true, 'data' => SubscriberResource::collection($subscribers)]);
    }

    public function show(Subscriber $subscriber): JsonResponse
    {
        return response()->json(['success' => true, 'data' => new SubscriberResource($subscriber)]);
    }

    public function store(SubscriberStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->handleSave($data, new Subscriber());

        return response()->json(['success' => true]);
    }

    public function update(SubscriberUpdateRequest $request, Subscriber $subscriber): JsonResponse
    {
        $data = $request->validated();
        $this->handleSave($data, $subscriber);

        return response()->json(['success' => true]);
    }

    private function handleSave(array $data, Subscriber $subscriber): void
    {
        $subscriber->fill($data)->save();
        $fieldsForSync = [];

        if (isset($data['fields'])) {
            $fields = $data['fields'];
            unset($data['fields']);

            /** Make an array that can be accepted by sync() function. Expected result: field_id => ['value' => 'some value...'] */
            $fieldsForSync = array_combine(array_column($fields, 'id'), array_column($fields, 'value'));
            foreach ($fieldsForSync as $id => $value) {
                if (!is_null(Field::find($id))) {
                    $fieldsForSync[$id] = ['value' => $value];
                } else {
                    unset($fieldsForSync[$id]);
                }
            }
        }

        $subscriber->fields()->sync($fieldsForSync);
    }

    public function destroy(Subscriber $subscriber): JsonResponse
    {
        $subscriber->delete();

        return response()->json(['success' => true]);
    }
}
