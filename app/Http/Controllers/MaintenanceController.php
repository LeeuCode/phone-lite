<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;

class MaintenanceController extends Controller
{
    public function index()
    {
        $devices = Maintenance::orderBy('created_at', 'DESC')->paginate(20);
        return view('maintenance.index', ['devices' => $devices]);
    }

    public function receipt()
    {
        return view('maintenance.receipt');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', 'malfunction']);
        $maintenance = Maintenance::create($data);

        if (isset($request->malfunction)) {
            Maintenance::where('id', $maintenance->id)->update([
                'malfunction' => json_encode($request->malfunction)
            ]);
        }

        return redirect()->back()->with('success', __('تم أضافة جهاز جديد بنجاح !'));
    }

    public function edit($id)
    {
        $device = Maintenance::find($id);
        return view('maintenance.edit', ['device' => $device]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', 'malfunction']);
        $maintenance =   Maintenance::where('id', $id)->update($data);

        if (isset($request->malfunction)) {
            Maintenance::where('id', $id)->update([
                'malfunction' => json_encode($request->malfunction)
            ]);
        }

        return redirect()->back()->with('success', __('تم تعديل الجهاز بنجاح !'));
    }

    public function delivery($id)
    {
        $device = Maintenance::find($id);
        return view('maintenance.delivery', ['device' => $device]);
    }


    public function search(Request $request)
    {
        $devices = Maintenance::where('agent_name', 'like', '%' . $request->agent_name . '%');

        $request = $request->except(['agent_name']);

        // if (isset($request->agent_name)) {
        //   $devices->where('agent_name', 'like','%'.$request->agent_name.'%');
        // }

        // Get all request and loop to search
        foreach ($request as $key => $value) {
            if (!is_null($value))
                $devices->where($key, $value);
        }

        return view('maintenance.index', ['devices' => $devices->paginate(20)]);
    }
}
