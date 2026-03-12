<?php

namespace App\Models;

enum PaymentStatusEnum: string
{
    case Pending = 'Pending';
    case Paid = 'Paid';
    case NotPaid = 'NotPaid';
    case Late = 'Late';
    case PartiallyPaid = 'PartiallyPaid';
}
