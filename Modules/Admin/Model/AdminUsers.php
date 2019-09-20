<?php

namespace Modules\Admin\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class AdminUsers extends Authenticatable
{
    use Notifiable,HasRoles;

}
