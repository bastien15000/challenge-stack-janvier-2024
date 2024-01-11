<?php

namespace App\Enum;

enum NotifType: string
{
    case Info = "info";
    case Warning = "attention";
    case Alert = "alerte";
}
