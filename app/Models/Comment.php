<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_RADIO = [
        'block' => 'Block',
        'safe'  => 'Safe',
    ];

    public $table = 'comments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'feed_id',
        'sender_id',
        'comment',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class, 'feed_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
