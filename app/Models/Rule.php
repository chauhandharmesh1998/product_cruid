<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['rule_name', 'apply_tags'];

    public function conditions()
    {
        return $this->hasMany(RuleCondition::class);
    }
}
