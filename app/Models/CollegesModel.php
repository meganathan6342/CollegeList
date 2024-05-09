<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegesModel extends Model
{
    use HasFactory;

    protected $table = 'colleges';

    protected $primaryKey = 'college_id';

    public $incrementing = false;

    protected $fillable = ['college_name'];

    public function addresses()
    {
        return $this->belongsTo(AddressesModel::class, 'address_id');
    }
    public function departments()
    {
        return $this->hasMany(DepartmentsModel::class, 'college_id')->where('college_id');
    }
    public function staffs()
    {
        return $this->hasMany(StaffsModel::class, 'college_id')->where('college_id');
    }
    public function students()
    {
        return $this->hasMany(StudentsModel::class, 'college_id')->where('college_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($college) {
            $college->addresses()->delete();
        });

        static::deleting(function ($college) {
            $college->departments()->delete();
        });

        static::deleting(function ($college) {
            $college->staffs()->each(function ($staff) {
                $staff->addresses->delete();
                $staff->delete();
            });
        });

        static::deleting(function ($college) {
            $college->students()->each(function ($student) {
                $student->addresses->delete();
                $student->delete();
            });
        });
    }
}
