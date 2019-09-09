<?php

namespace Modules\Admin\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUsers extends Authenticatable
{
    use Notifiable;

}
