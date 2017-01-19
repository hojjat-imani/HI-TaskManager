<?php
/**
 * Created by PhpStorm.
 * User: hojjatimani
 * Date: 1/19/2017 AD
 * Time: 2:35 PM
 */

use App\User;
use App\Task;
use App\Tasklist;

namespace App\Repositories;


class TasklistRepository
{
    public function forUser(User $user)
    {
        return Tasklist::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}