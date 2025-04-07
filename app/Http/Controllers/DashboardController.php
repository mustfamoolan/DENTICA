<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\DentalClinic;
use App\Models\ClinicNote;
use App\Models\InvoiceType;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * عرض لوحة التحكم
     */
    public function index(Request $request)
    {
        // إذا كان الطلب يريد الإحصائيات فقط
        if ($request->has('get_stats')) {
            return $this->getStats();
        }

        // حساب عدد المرضى الجدد خلال الشهر الحالي
        $newPatientsCount = Patient::whereMonth('registration_date', Carbon::now()->month)
            ->whereYear('registration_date', Carbon::now()->year)
            ->count();

        // حساب عدد مواعيد اليوم
        $todayAppointmentsCount = Appointment::whereDate('appointment_date', Carbon::today())->count();

        // حساب عدد مواعيد الأمس للمقارنة
        $yesterdayAppointmentsCount = Appointment::whereDate('appointment_date', Carbon::yesterday())->count();

        // الحصول على مواعيد اليوم مع بيانات المرضى (أقصى 14 موعد)
        $todayAppointments = Appointment::with('patient')
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time')
            ->take(11)
            ->get();

        // إضافة قائمة المرضى للمودال
        $patients = Patient::all();

        // جلب آخر 4 مرضى تمت إضافتهم
        $latestPatients = Patient::latest()->take(4)->get();

        // جلب العيادة الحالية
        $clinic = DentalClinic::first();

        // جلب آخر 6 ملاحظات
        $latestNotes = ClinicNote::where('dental_clinic_id', $clinic->id)
            ->latest()
            ->take(6)
            ->get();

        // جلب أنواع الفواتير
        $invoiceTypes = InvoiceType::where('dental_clinic_id', $clinic->id)->get();

        // إضافة إحصائيات الفواتير
        $invoicesCount = Invoice::count();
        $totalAmount = Invoice::sum('amount');
        $paidAmount = Invoice::sum('paid_amount');
        $remainingAmount = Invoice::sum('remaining_amount');

        return view('dashboard', compact(
            'newPatientsCount',
            'todayAppointmentsCount',
            'yesterdayAppointmentsCount',
            'todayAppointments',
            'patients',
            'latestPatients',
            'clinic',
            'latestNotes',
            'invoiceTypes',
            'invoicesCount',
            'totalAmount',
            'paidAmount',
            'remainingAmount'
        ));
    }

    /**
     * جلب آخر المرضى المضافين للعرض في لوحة التحكم
     */
    public function getLatestPatients(Request $request)
    {
        $limit = $request->input('limit', 4);
        $latestPatients = Patient::latest()->take($limit)->get();

        return view('partials.latest_patients', compact('latestPatients'))->render();
    }

    /**
     * جلب مواعيد اليوم للعرض في لوحة التحكم
     */
    public function getTodayAppointments(Request $request)
    {
        $limit = $request->input('limit', null);

        $query = Appointment::with('patient')
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time');

        if ($limit) {
            $query->take($limit);
        }

        $todayAppointments = $query->get();

        return view('partials.today_appointments', compact('todayAppointments'))->render();
    }

    /**
     * الحصول على الأوقات المتاحة للتاريخ المحدد
     */
    public function getAvailableTimes(Request $request)
    {
        $date = $request->input('date');

        if (!$date) {
            return response()->json(['error' => 'التاريخ مطلوب'], 400);
        }

        // الحصول على جميع المواعيد في هذا التاريخ
        $bookedAppointments = Appointment::whereDate('appointment_date', $date)
            ->pluck('appointment_time')
            ->map(function($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        // إنشاء قائمة بجميع الأوقات المتاحة (من 9 صباحًا إلى 5 مساءً بفاصل 30 دقيقة)
        $allTimes = [];
        $startTime = Carbon::createFromTime(9, 0, 0);
        $endTime = Carbon::createFromTime(17, 30, 0);

        while ($startTime <= $endTime) {
            $timeString = $startTime->format('H:i');
            $allTimes[] = [
                'time' => $timeString,
                'formatted' => $startTime->format('h:i A'),
                'available' => !in_array($timeString, $bookedAppointments)
            ];

            $startTime->addMinutes(30);
        }

        return response()->json($allTimes);
    }

    /**
     * الحصول على إحصائيات لوحة التحكم
     */
    public function getStats()
    {
        // حساب عدد مواعيد اليوم
        $todayAppointmentsCount = Appointment::whereDate('appointment_date', Carbon::today())->count();

        // حساب عدد مواعيد الأمس للمقارنة
        $yesterdayAppointmentsCount = Appointment::whereDate('appointment_date', Carbon::yesterday())->count();

        // حساب عدد المرضى الجدد خلال الشهر الحالي
        $newPatientsCount = Patient::whereMonth('registration_date', Carbon::now()->month)
            ->whereYear('registration_date', Carbon::now()->year)
            ->count();

        // إضافة إحصائيات الفواتير
        $invoicesCount = Invoice::count();
        $totalAmount = Invoice::sum('amount');
        $paidAmount = Invoice::sum('paid_amount');
        $remainingAmount = Invoice::sum('remaining_amount');

        return response()->json([
            'todayAppointmentsCount' => $todayAppointmentsCount,
            'yesterdayAppointmentsCount' => $yesterdayAppointmentsCount,
            'newPatientsCount' => $newPatientsCount,
            'invoicesCount' => $invoicesCount,
            'totalAmount' => $totalAmount,
            'paidAmount' => $paidAmount,
            'remainingAmount' => $remainingAmount
        ]);
    }
}
