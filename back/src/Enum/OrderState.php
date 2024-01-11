<?php

namespace App\Enum;

enum OrderState: string
{
    case Incoming = 'à livrer';
    case Ongoing = 'en cours de livraison';
    case Delivered = 'livrée';
    case Cancelled = 'annulée';
}
