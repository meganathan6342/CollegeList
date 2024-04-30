<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffsModel extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $primaryKey = 'staff_id';

    public $incrementing = false;

    protected $fillable = ['staff_name', 'staff_gender', 'staff_dob', 'mobile_no', 'dept_short_code'];

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
}
