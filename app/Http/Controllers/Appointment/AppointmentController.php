<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;


class AppointmentController extends Controller
{
    // Display a listing of the appointments.
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->latest()->paginate(20);
        return view('appointments.index', compact('appointments'));
    }

    // Show the form for creating a new appointment.
    public function create()
    {
        $patients = \App\Models\Patient::all();
       $doctors = \App\Models\Doctor::all();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    // Store a newly created appointment in storage.
public function store(Request $request)
{
    $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'doctor_id'  => 'required|exists:doctors,id',
        'date'       => 'required|date',
        'time'       => 'required',
    ]);

    // Generate unique appointment number (e.g. APPT-YYYYMMDD-XXXX)
    $datePart = now()->format('Ymd');
    $randomPart = strtoupper(uniqid());
    $appointmentNumber = 'APPT-' . $datePart . '-' . $randomPart;

    Appointment::create([
        'patient_id' => $request->patient_id,
        'doctor_id'  => $request->doctor_id,
        'date'       => $request->date,
        'time'       => $request->time,
        'appointment_number' => $appointmentNumber,
    ]);

    return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
}

    // Display the specified appointment.
    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    // Show the form for editing the specified appointment.
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = \App\Models\Patient::all();
        $doctors = \App\Models\Doctor::all();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    // Update the specified appointment in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id'  => 'required|exists:doctors,id',
            'date'       => 'required|date',
            'time'       => 'required',
            'status'     => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->only('patient_id', 'doctor_id', 'date', 'time', 'status'));

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    // Cancel the specified appointment.
    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Cancelled';
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully.');
    }

    // Remove the specified appointment from storage.
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    // Show the appointment queue.
  public function queue()
{
    $appointments = Appointment::with(['patient', 'doctor'])
        ->where('status', 'Scheduled') // or your logic
        ->orderBy('date')
        ->orderBy('time')
        ->get();

    return view('appointments.queue', compact('appointments'));
}


    // Start an appointment (change status to In Progress).
    public function start($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'In Progress';
        $appointment->save();

        return redirect()->route('appointments.queue')->with('success', 'Appointment started.');
    }
}