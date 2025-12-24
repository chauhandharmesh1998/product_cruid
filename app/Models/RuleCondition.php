<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleCondition extends Model
{
    protected $fillable = [
        'rule_id','field','operator','value'
    ];
}
