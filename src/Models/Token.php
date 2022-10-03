<?php

namespace Zaoob\Laravel\Tokenable\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zaoom_tokans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'token',
        'last_use',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'modelable_type',
        'modelable_id',
    ];

    public function getLastUseAttribute($date)
    {
        if (is_null($date)) {
            return null;
        } else {
            return Carbon::parse($date)->format('dd, mm, YY');
        }
    }

    public function model($model = null)
    {
        if ($model && $model != $this->modelable_type) {
            abort(404);
        }
        $model->update([
            'last_use' => Carbon::now(),
        ]);

        return (new $this->modelable_type)->find($this->modelable_id);
    }
}
