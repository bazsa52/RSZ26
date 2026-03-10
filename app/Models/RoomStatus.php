<?php

namespace App\Models;

enum RoomStatus: string
{
    case Available = 'Available';
    case Booked = 'Booked';
    case UnderRepair = 'UnderRepair';
    case Maintenance = 'Maintenance';
    case Damaged = 'Damaged';
}
