<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestEquipment;

class TestEquipmentController extends Controller
{
    // หน้าแสดงรายการ
    public function index()
    {
        $equipments = TestEquipment::orderByDesc('id')->get();

        return view('admin.test_equipment.index', [
            'equipments' => $equipments
        ]);
    }

    // หน้าเพิ่มข้อมูล
    public function createEquipment()
    {
        return view('admin.test_equipment.create_equipment');
    }

    // บันทึกข้อมูลใหม่
    public function store(Request $request)
    {
        TestEquipment::create([
            'item_type'       => $request->asset_type,
            'manufacturer'    => $request->manufacturer,
            'model'           => $request->model,
            'dsn_name'        => $request->dsn_name ?? '-',
            'serial_no'       => $request->serial_no,
            'label'           => $request->label ?? '-',
            'purchase_date'   => $request->purchase_date,
            'warranty_remain' => $request->warranty_remain ?? '-',
            'user'            => 'Admin',
        ]);

        return redirect()->route('test-equipment.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    // แสดงฟอร์มแก้ไข
    public function edit($id)
    {
        $equipment = TestEquipment::findOrFail($id);
        return view('admin.test_equipment.create_equipment', compact('equipment'));
    }

    // บันทึกการแก้ไข
    public function update(Request $request, $id)
    {
        $equipment = TestEquipment::findOrFail($id);

        $equipment->update([
            'item_type'       => $request->asset_type,
            'manufacturer'    => $request->manufacturer,
            'model'           => $request->model,
            'dsn_name'        => $request->dsn_name ?? '-',
            'serial_no'       => $request->serial_no,
            'label'           => $request->label ?? '-',
            'purchase_date'   => $request->purchase_date,
            'warranty_remain' => $request->warranty_remain ?? '-',
            'user'            => 'Admin',
        ]);

        return redirect()->route('test-equipment.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    // Delete item
    public function destroy($id)
    {
        $equipment = TestEquipment::findOrFail($id);
        $equipment->delete();

        return redirect()
            ->route('test-equipment.index')
            ->with('deleted', 'ลบรายการเรียบร้อยแล้ว');
    }
}
