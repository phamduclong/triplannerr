<?php

namespace App\Models;

use Altek\Accountant\Contracts\Recordable;
use Altek\Accountant\Recordable as RecordableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recording.
 */
abstract class Recording extends Model implements Recordable
{
    use RecordableTrait;
}
