<?php

namespace App\Http\Controllers\admin\event;

use App\Http\Controllers\Controller;
use App\Imports\EventReminderImport;
use App\Models\Event;
use App\Models\EventReminder;
use App\Repositories\SaveRepository;
use App\Repositories\ValidationRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class EventReminderController extends Controller
{
    private $vr;
    private $save;
    public function __construct(ValidationRepository $validationRepository, SaveRepository $saveRepository)
    {
        $this->vr   = $validationRepository;
        $this->save = $saveRepository;
    }

    public function index()
    {
        $events = Event::where('status',1)->where('from_date','>=',date('Y-m-d'))->pluck('title', 'id');
        return view('admin.events.event_reminder.index',compact('events'));
    }

    public function save(Request $request, $id = null)
    {
        $status = $this->save->EventReminder($request,$id);

        if ($status == 'success') {
            if (!empty($id)) {
                return redirect(route('city.index'))->with(['success' => 'successfully saved']);
            }
            return back()->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    public function datatable()
    {
        $info = EventReminder::orderby('id', 'DESC');
    
        return DataTables::of($info)
            ->editColumn('reminder_id', function ($data) {
                return $data->reminder_id ?? '';
            })
            ->editColumn('event_id', function ($data) {
                return $data->event->title ?? '';
            })
            ->editColumn('reminder_time', function ($data) {
                return commonDateFormat($data->created_at);

            })
            ->rawColumns(['reminder_id', 'event_id', 'reminder_time'])
            ->make(true);
    }
    

    public function import(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                Excel::import(new EventReminderImport(), $file, null, \Maatwebsite\Excel\Excel::XLSX); // Specify XLSX as the file type
                return redirect()->back()->with('success', 'Events imported successfully.');
            } else {
                return redirect()->back()->with('error', 'No file uploaded.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing events: ' . $e->getMessage());
        }
    }
}
