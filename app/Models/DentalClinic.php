<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalClinic extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها بشكل جماعي
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'opening_time',
        'closing_time',
    ];

    /**
     * تحويل الحقول إلى أنواع بيانات محددة
     *
     * @var array
     */
    protected $casts = [
        'opening_time' => 'datetime',
        'closing_time' => 'datetime',
    ];

    /**
     * العلاقة مع الأطباء
     */
    public function doctors()
    {
        return $this->hasMany(DentalDoctor::class);
    }

    /**
     * العلاقة مع المرضى
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * علاقة مع ملاحظات العيادة
     */
    public function notes()
    {
        return $this->hasMany(ClinicNote::class);
    }

    /**
     * علاقة العيادة بالفواتير
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * علاقة العيادة بأنواع الفواتير
     */
    public function invoiceTypes()
    {
        return $this->hasMany(InvoiceType::class);
    }

    /**
     * علاقة العيادة بالتنبيهات
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
