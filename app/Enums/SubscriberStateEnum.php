<?php

namespace App\Enums;

enum SubscriberStateEnum:string {
    case Active = 'active';
    case Unsubscribed = 'unsubscribed';
    case Junk = 'junk';
    case Bounced = 'bounced';
    case Unconfirmed = 'unconfirmed';
}
