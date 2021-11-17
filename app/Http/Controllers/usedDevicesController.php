<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usedDevice;

class usedDevicesController extends Controller
{
    public function index()
    {
      $devices = usedDevice::where('state', null)->orderBy('id', 'DESC')->paginate(15);
      $devicesCount = usedDevice::where('state', null)->count();
      $devicesSale = usedDevice::where('state', 1)->count();

      return view('used-devices.index', [
        'devices' => $devices,
        'devicesCount' => $devicesCount,
        'devicesSale' => $devicesSale
      ]);
    }

    public function devicesSale()
    {
      $devices = usedDevice::where('state', 1)->orderBy('id', 'DESC')->paginate(15);
      $devicesCount = usedDevice::where('state', null)->count();
      $devicesSale = usedDevice::where('state', 1)->count();

      return view('used-devices.index', [
        'devices' => $devices,
        'devicesCount' => $devicesCount,
        'devicesSale' => $devicesSale
      ]);
    }

    public function search(Request $request)
    {
      $req = $request->except(['agent_name', 'from', 'to']);

      $devices = usedDevice::where('state', null);

      if (isset($request->agent_name)) {
        $devices->where('agent_name', 'like', '%'. $request->agent_name .'%');
      }

      foreach ($req as $key => $value) {
        if(!empty($value)) {
          $devices->where($key, $value);
        }
      }

      $devs = $devices->paginate(15);

      $devicesCount = usedDevice::where('state', null)->count();
      $devicesSale = usedDevice::where('state', 1)->count();

      return view('used-devices.index', [
        'devices' => $devs,
        'devicesCount' => $devicesCount,
        'devicesSale' => $devicesSale
      ]);
    }

    public function create()
    {
      return view('used-devices.create');
    }

    public function store(Request $request)
    {
      $data = $request->except(['_token']);
      usedDevice::create($data);

      return redirect()->back()->with('success', __('تم شراء جهاز مستعمل جديد'));
    }

    public function sale(Request $request, $id)
    {
      $data = $request->except(['_token']);
      usedDevice::where('id', $id)->update($data);

      return redirect()->back()->with('success', __('تم بيع جهاز مستعمل جديد'));
    }
}
