<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class UserMetadata extends AuthTmp
{
    protected $table = 'user_metadata';

    protected $fillable = [
        'id', 'createdAt', 'updatedAt', 'deletedAt', 'user_id', 'player_code', 'turnover', 'team_turnover', 'ggr', 'team_ggr', 'level',
        'reward', 'team_reward', 'matching', 'wins', 'team_wins', 'user_active'
    ];

    public $timestamps = false;
}
