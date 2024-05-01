<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressesModel extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $primaryKey = 'address_id';
    protected $fillable = ['street_1', 'street_2', 'city', 'state', 'country'];

    public function colleges()
    {
        return $this->hasMany(CollegesModel::class, 'address_id');
    }
    public function staffs()
    {
        return $this->hasMany(StaffsModel::class, 'address_id');
    }
    public function students()
    {
        return $this->hasMany(StudentsModel::class, 'address_id');
    }
    
}
