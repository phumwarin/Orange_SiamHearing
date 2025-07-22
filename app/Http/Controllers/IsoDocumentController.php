<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IsoDocumentController extends Controller
{
    public function manage($key)
    {
        $keyMap = [
            'qm_tm' => 'QM-TM',
            'lab_organization' => 'Lab Organization',
            'ctf_documents' => 'CTF Documents',
            'master_list' => 'Master List',
            'calibration' => 'Calibration',
            'document_control' => 'Document Control',
            'audit' => 'Audit',
            'management_review' => 'Management Review',
            'man_power_training' => 'Man Power and Training',
            'customer_complain' => 'Customer Complain',
            'purchasing_service' => 'Purchasing Service',
            'non_cr_car' => 'NON-CR / CAR',
            'uncertainty' => 'Uncertainty',
            'iso_format' => 'ISO Format',
            'test_procedure_wi' => 'Test Procedure / WI',
            'interlab_test' => 'Interlab Test',
            'subcontract' => 'Subcontract',
        ];

        $label = $keyMap[$key] ?? ucfirst(str_replace('_', ' ', $key));

        return view('admin.iso_documents.manage', compact('key', 'label'));
    }
}
