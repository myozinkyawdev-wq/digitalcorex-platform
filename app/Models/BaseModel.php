<?php

namespace App\Models;

use App\Models\Traits\HasGetterAttributes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{
    use HasUuids;
    use HasFactory;
    use HasGetterAttributes;
}