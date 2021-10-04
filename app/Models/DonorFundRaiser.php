<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonorFundRaiser extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'donor_fund_raisers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'fundraiser_id',
        'amount',
        'caption',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fundraiser()
    {
        return $this->belongsTo(OwnerFundRaiser::class, 'fundraiser_id');
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
