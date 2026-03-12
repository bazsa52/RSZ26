<?php

namespace App\Models;

enum RoleEnum: string
{
    case Admin = 'Admin';
    case Receptionist = 'Receptionist';
    case User = 'User';
}
