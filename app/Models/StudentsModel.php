<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsModel extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'student_id';

    public $incrementing = false;

    protected $fillable = ['student_name', 'student_gender', 'student_dob', 'mobile_no', 'dept_short_code'];

    public function addresses()
    {
        return $this->belongsTo(AddressesModel::class, 'address_id');
    }
    public function colleges()
    {
        return $this->belongsTo(CollegesModel::class, 'college_id');
    }
    public function departments()
    {
        return $this->belongsTo(DepartmentsModel::class, 'dept_short_code');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($student) {
            $student->addresses()->delete();
        });
    }
}
