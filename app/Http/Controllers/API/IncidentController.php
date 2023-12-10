<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incident;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    /**
     * Create new incident
     */
    public function create(Request $request)
    {
        try {
            $incident = new Incident();
            $incident->health_facility_id = $request->healthFacilityId;
            $incident->reported_datetime = Carbon::now();
            $incident->nature_of_operation = $request->nature;
            $incident->transfer_category = $request->category;
            $incident->transfer_vicinity = $request->vicinity;
            $incident->from_health_facility_id = $request->fromHealthFacilityId === 'self' ? Auth()->user()->health_facility_id : $request->fromHealthFacilityId;
            $incident->to_health_facility_id = $request->toHealthFacilityId === 'self' ? Auth()->user()->health_facility_id : $request->toHealthFacilityId;
            $incident->origin = $request->origin;
            $incident->destination = $request->destination;
            $incident->status = 'pending';
            $incident->patient_ehr_id = $request->patientEhrId;
            $incident->patient_first_name = $request->patientFirstName;
            $incident->patient_last_name = $request->patientLastName;
            $incident->patient_middle_name = $request->patientMiddleName;
            $incident->patient_birthdate = $request->patientBirthdate;
            $incident->patient_address = $request->patientAddress;
            $incident->chief_complaint = $request->chiefComplaint;
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
