<?php

namespace App\Models;

enum PaymentStatus : String
{
    case PENDING = 'PENDING';
    case COMPLETED = 'COMPLETED';
    case FAILED = 'FAILED';
}
