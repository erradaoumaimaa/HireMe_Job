<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


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
