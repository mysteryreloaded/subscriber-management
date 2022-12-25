<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberStoreRequest;
use App\Http\Requests\SubscriberUpdateRequest;
use App\Http\Resources\SubscriberResource;
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
        (new Subscriber())->fill($data)->save();

        return response()->json(['success' => true]);
    }

    public function update(SubscriberUpdateRequest $request, Subscriber $subscriber): JsonResponse
    {
        $data = $request->validated();
        $subscriber->update($data);

        return response()->json(['success' => true]);
    }

    public function destroy(Subscriber $subscriber): JsonResponse
    {
        $subscriber->delete();

        return response()->json(['success' => true]);
    }
}
