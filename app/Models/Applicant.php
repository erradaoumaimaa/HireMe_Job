<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'current_post', 
        'industry',
        'address',
        'contact',
        'about',
        'title',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curriculumVitae()
    {
        return $this->hasOne(CurriculumVitae::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
