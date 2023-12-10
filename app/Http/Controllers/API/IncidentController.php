<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IncidentResource;
use App\Models\HealthFacility;
use App\Models\Incident;
use Carbon\Carbon;

class IncidentController extends Controller
{
    public function index() {
        $incidents = Incident::select([
            "id",
            "health_facility_id",
            "transfer_category as category",
            "reported_datetime as reportedDatetime",
            "transfer_vicinity as vicinity",
            "from_health_facility_id",
            "to_health_facility_id",
            "origin",
            "destination",
            "status",
            "patient_ehr_id as patientEhrId",
            "patient_first_name as patientFirstName",
            "patient_last_name as patientLastName",
            "patient_middle_name as patientMiddleName",
            "patient_birthdate as patientBirthdate",
            "patient_address as patientAddress",
            "chief_complaint as chiefComplaint",
            "remarks",
            "status",
            "created_at as createdAt",
            "created_by as createdBy"
        ])
            ->with('healthFacility:id,hf_name')
            ->with('fromHealthFacility:id,hf_name')
            ->with('toHealthFacility:id,hf_name')
            ->orderBy('created_at', 'DESC')
            ->get();
        $incidents = $incidents->each(function($item, $key){
            $item->statusLabel = $item->getStatus($item->status);
            $item->categoryLabel = $item->getCategory($item->category);
            $item->vicinityLabel = $item->getVicinity($item->vicinity);
            $item->healthFacilityId = $item->healthFacility->id;
            unset($item->health_facility_id);
            $item->fromHealthFacilityId = $item->from_health_facility_id;
            unset($item->from_health_facility_id);
            $item->toHealthFacilityId = $item->to_health_facility_id;
            unset($item->to_health_facility_id);
            $item->origin = json_decode($item->origin);
            $item->destination = json_decode($item->destination);
        });
        
        return IncidentResource::collection($incidents);
    }

    /**
     * Create new incident
     */
    public function store(Request $request)
    {
        try {
            $origin = null;
            if ($request->fromHealthFacilityId === 'self') {
                $originFacility = HealthFacility::find(Auth()->user()->health_facility_id);
                $origin = $originFacility->hf_location;
            } elseif ($request->fromHealthFacilityId) {
                $originFacility = HealthFacility::find($request->fromHealthFacilityId);
                $origin = $originFacility->hf_location;
            } else {
                $origin = $request->origin;
            }

            $destination = null;
            if ($request->toHealthFacilityId === 'self') {
                $destinationFacility = HealthFacility::find(Auth()->user()->health_facility_id);
                $destination = $destinationFacility->hf_location;
            } elseif ($request->toHealthFacilityId) {
                $destinationFacility = HealthFacility::find($request->toHealthFacilityId);
                $destination = $destinationFacility->hf_location;
            } else {
                $destination = $request->destination;
            }

            $incident = new Incident();
            $incident->health_facility_id = $request->healthFacilityId;
            $incident->reported_datetime = Carbon::now();
            $incident->nature_of_operation = $request->nature;
            $incident->transfer_category = $request->category;
            $incident->transfer_vicinity = $request->vicinity;
            $incident->from_health_facility_id = $request->fromHealthFacilityId === 'self' ? Auth()->user()->health_facility_id : $request->fromHealthFacilityId;
            $incident->to_health_facility_id = $request->toHealthFacilityId === 'self' ? Auth()->user()->health_facility_id : $request->toHealthFacilityId;
            $incident->origin = $origin;
            $incident->destination = $destination;
            $incident->status = 0;
            $incident->patient_ehr_id = $request->patientEhrId;
            $incident->patient_first_name = $request->patientFirstName;
            $incident->patient_last_name = $request->patientLastName;
            $incident->patient_middle_name = $request->patientMiddleName;
            $incident->patient_birthdate = Carbon::createFromFormat('Y-m-d', $request->patientBirthdate);
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

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Incident::find($id));
    }
}
