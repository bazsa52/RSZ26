<?php

namespace App\Models;

enum PaymentState: string
{
    case Pending = 'Pending';
    case Paid = 'Paid';
    case NotPaid = 'NotPaid';
    case Late = 'Late';
    case PartiallyPaid = 'PartiallyPaid';
}
