<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'slogan',
        'industry',
        'body',
        'user_id',
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
    public function Applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
