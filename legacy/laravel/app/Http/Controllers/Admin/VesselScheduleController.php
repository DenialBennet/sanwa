<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VesselSchedule;
use Illuminate\Http\Request;

class VesselScheduleController extends Controller
{
    // Pre-defined vessels for dropdown
    public static $vessels = [
        'KM. KINTAMANI',
        'KM. CALYPSO',
        'KM. SAKURA 09',
        'KM. PACIFIC 88',
    ];

    public function index(Request $request)
    {
        $query = VesselSchedule::query();

        // 1. Search by Vessel Name
        if ($request->filled('search')) {
            $query->where('kapal', 'like', '%' . $request->search . '%');
        }

        // 2. Range Closing Date
        if ($request->filled('closing_start')) {
            $query->whereDate('closing', '>=', $request->closing_start);
        }
        if ($request->filled('closing_end')) {
            $query->whereDate('closing', '<=', $request->closing_end);
        }

        // 3. Range ETD Date
        if ($request->filled('etd_start')) {
            $query->whereDate('etd_sub', '>=', $request->etd_start);
        }
        if ($request->filled('etd_end')) {
            $query->whereDate('etd_sub', '<=', $request->etd_end);
        }

        // 4. Filter by Status
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'full') {
                $query->where('is_full', true);
            } elseif ($status === 'closed') {
                $query->where('is_full', false)->where('closing', '<', now());
            } elseif ($status === 'available') {
                $query->where('is_full', false)->where('closing', '>=', now());
            }
        }

        $schedules = $query->orderBy('etd_sub', 'desc')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $vessels = self::$vessels;
        return view('admin.schedules.create', compact('vessels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kapal' => ['required', 'string'],
            'voy' => ['required', 'string'],
            'closing' => ['required', 'date'],
            'etd_sub' => ['required', 'date'],
        ]);

        $validated['is_full'] = $request->has('is_full');

        VesselSchedule::create($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kapal berhasil ditambahkan.');
    }

    public function edit(VesselSchedule $schedule)
    {
        $vessels = self::$vessels;
        return view('admin.schedules.edit', compact('schedule', 'vessels'));
    }

    public function update(Request $request, VesselSchedule $schedule)
    {
        $validated = $request->validate([
            'kapal' => ['required', 'string'],
            'voy' => ['required', 'string'],
            'closing' => ['required', 'date'],
            'etd_sub' => ['required', 'date'],
        ]);

        $validated['is_full'] = $request->has('is_full');

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kapal berhasil diperbarui.');
    }

    public function destroy(VesselSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kapal berhasil dihapus.');
    }
}
