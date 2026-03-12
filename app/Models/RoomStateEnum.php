<?php

namespace App\Models;

enum RoomStateEnum: string
{
    case Available = 'Available';
    case Booked = 'Booked';
    case UnderRepair = 'UnderRepair';
    case Maintenance = 'Maintenance';
    case Damaged = 'Damaged';
}
