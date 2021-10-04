<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RateJournal extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'rate_journals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'journal_id',
        'user_id',
        'rate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
