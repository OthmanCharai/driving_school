<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $question
 * @property string $voice
 * @property int $sub_exam_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'voice',
        'sub_exam_id',
        'image'
    ];



    /**
     * @return BelongsTo
     */
    public function subExam(): BelongsTo
    {
        return $this->belongsTo(SubExam::class);
    }


    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    /**
     * @return HasMany
     */
    public function dropzons(): HasMany
    {
        return $this->hasMany(Dropzon::class);
    }
}
