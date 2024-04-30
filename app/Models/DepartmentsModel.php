<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentsModel extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $primaryKey = 'dept_short_code';

    public $incrementing = false;

    protected $fillable = ['dept_name'];

    public function colleges()
    {
        return $this->belongsTo(CollegesModel::class, 'college_id');
    }
    public function staffs()
    {
        return $this->hasMany(StaffsModel::class, 'dept_short_code');
    }
    public function students()
    {
        return $this->hasMany(StudentsModel::class, 'dept_short_code');
    }

    protected static function generateUniqueKey()
    {
        $key = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);

        while (static::where('dept_short_code', $key)->exists()) {
            $key = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
        }
        return $key;
    }
}
