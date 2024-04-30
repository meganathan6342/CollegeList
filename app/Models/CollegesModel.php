<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegesModel extends Model
{
    use HasFactory;

    protected $table = 'colleges';

    protected $primaryKey = 'college_id';

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
}
