<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incident;

class IncidentController extends Controller
{
    /**
     * Create new incident
     */
    public function create(Request $request)
    {
        try {
            $incident = new Incident();
            $incident->health_facility_id = $request->health_facility_id;
            $incident->reported_datetime = $request->reported_datetime;
            $incident->nature_of_operation = $request->nature_of_operation;
            $incident->transfer_category = $request->transfer_category;
            $incident->transfer_vicinity = $request->transfer_vicinity;
            $incident->from_health_facility_id = $request->from_health_facility_id;
            $incident->to_health_facility_id = $request->to_health_facility_id;
            $incident->origin = $request->origin;
            $incident->destination = $request->destination;
            $incident->status = $request->status;
            $incident->patient_ehr_id = $request->patient_ehr_id;
            $incident->patient_first_name = $request->patient_first_name;
            $incident->patient_last_name = $request->patient_last_name;
            $incident->patient_middle_name = $request->patient_middle_name;
            $incident->patient_birthdate = $request->patient_birthdate;
            $incident->patient_address = $request->patient_address;
            $incident->chief_complaint = $request->chief_complaint;
            $incident->remarks = $request->remarks;
            $incident->created_by = Auth()->user()->id;
            $incident->save();

            $success = true;
            $message = 'New Transport Request Created';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
