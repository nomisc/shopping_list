<?php

namespace App\Models;

use Illuminate\Database\{
    Eloquent\Concerns\HasUuids,
    Eloquent\Factories\HasFactory,
    Eloquent\Model,
    Eloquent\SoftDeletes
};
use Illuminate\Support\Facades\Auth;

class ShoppingList extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = ['item','checked'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(callback: function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });

        static::restoring(function ($model) {
            $model->deleted_by = null;
            $model->save();
        });
    }
}
