<?php

namespace App\Enums;

enum FieldTypeEnum:string {
    case Date = 'date';
    case Number = 'number';
    case String = 'string';
    case Boolean = 'boolean';
}
