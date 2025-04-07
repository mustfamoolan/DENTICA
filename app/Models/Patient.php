<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها بشكل جماعي
     *
     * @var array
     */
    protected $fillable = [
        'dental_clinic_id',
        'full_name',
        'age',
        'gender',
        'phone_number',
        'occupation',
        'address',
        'patient_number',
        'registration_date',
        'registration_time',
        'notes',
    ];

    /**
     * تحويل الحقول إلى أنواع بيانات محددة
     *
     * @var array
     */
    protected $casts = [
        'registration_date' => 'date',
        'registration_time' => 'datetime',
    ];

    /**
     * العلاقة مع العيادة
     */
    public function dentalClinic()
    {
        return $this->belongsTo(DentalClinic::class);
    }

    /**
     * العلاقة مع الأمراض المزمنة
     */
    public function chronicDiseases()
    {
        return $this->belongsToMany(ChronicDisease::class, 'patient_chronic_disease');
    }

    /**
     * العلاقة مع الحساسية
     */
    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'patient_allergy');
    }

    /**
     * علاقة المريض بالفواتير
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
