<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * عرض قائمة المواعيد
     */
    public function index()
    {
        $appointments = Appointment::with('patient')->latest()->paginate(10);
        $patients = Patient::all();
        return view('appointments.index', compact('appointments', 'patients'));
    }

    /**
     * تخزين موعد جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'session_type' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'note' => 'nullable|string',
            'session_title' => 'nullable|string',
        ]);

        $appointment = Appointment::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'appointment' => $appointment]);
        }

        return redirect()->route('appointments.index')
            ->with('success', 'تم إضافة الموعد بنجاح');
    }

    /**
     * عرض موعد محدد
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * تحديث موعد محدد
     */
    public function update(Request $request, Appointment $appointment)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'amount' => 'nullable|numeric|min:0',
            'session_type' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // تحديث الموعد
        $appointment->update([
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'amount' => $request->amount,
            'session_type' => $request->session_type,
            'status' => $request->status,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'تم تحديث الموعد بنجاح');
    }

    /**
     * حذف موعد محدد
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'تم حذف الموعد بنجاح');
    }

    /**
     * تبديل حالة النجمة للموعد
     */
    public function toggleStar(Appointment $appointment)
    {
        $appointment->is_starred = !$appointment->is_starred;
        $appointment->save();

        return response()->json([
            'success' => true,
            'is_starred' => $appointment->is_starred
        ]);
    }

    /**
     * تبديل حالة الأرشفة للموعد
     */
    public function toggleArchive(Appointment $appointment)
    {
        $appointment->is_archived = !$appointment->is_archived;
        $appointment->save();

        return response()->json([
            'success' => true,
            'is_archived' => $appointment->is_archived
        ]);
    }

    /**
     * تمييز مواعيد متعددة بنجمة
     */
    public function starMultiple(Request $request)
    {
        $appointmentIds = $request->appointment_ids;

        Appointment::whereIn('id', $appointmentIds)
            ->update(['is_starred' => true]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * أرشفة مواعيد متعددة
     */
    public function archiveMultiple(Request $request)
    {
        $appointmentIds = $request->appointment_ids;

        Appointment::whereIn('id', $appointmentIds)
            ->update(['is_archived' => true]);

        return response()->json([
            'success' => true
        ]);
    }
}
