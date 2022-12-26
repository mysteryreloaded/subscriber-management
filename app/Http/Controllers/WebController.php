<?php

namespace App\Http\Controllers;

use App\Enums\FieldTypeEnum;
use App\Enums\SubscriberStateEnum;
use App\Http\Resources\FieldResource;
use App\Http\Resources\SubscriberResource;
use App\Models\Field;
use App\Models\Subscriber;

class WebController extends Controller
{
    public function index()
    {
        return view('index',
            [
                'subscribers' => SubscriberResource::collection(Subscriber::all()),
                'fields' => FieldResource::collection(Field::all()),
                'stateOptions' => array_column(SubscriberStateEnum::cases(), 'value'),
                'typeOptions' => array_column(FieldTypeEnum::cases(), 'value'),
                'routes' => [
                    'sub-index' => route('subscriber.index'),
                    'sub-store' => route('subscriber.store'),
                    'sub-update' => route('subscriber.update', ['subscriber' => '_ID_']),
                    'sub-destroy' => route('subscriber.destroy', ['subscriber' => '_ID_']),
                    'field-index' => route('field.index'),
                    'field-store' => route('field.store'),
                    'field-update' => route('field.update', ['field' => '_ID_']),
                    'field-destroy' => route('field.destroy', ['field' => '_ID_']),
                ]
            ]
        );
    }
}
