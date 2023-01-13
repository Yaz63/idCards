<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name','phone','email','image','job_no','job_id','location_id','status'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }
}
