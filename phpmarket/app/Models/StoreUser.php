<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\StoreUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StoreUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreUser query()
 * @mixin \Eloquent
 */
class StoreUser extends Pivot
{
    use SoftDeletes;
    public $incrementing = true;

}
