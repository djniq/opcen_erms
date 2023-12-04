<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHealthFacilityRequest;
use App\Http\Resources\HealthFacilityResource;
use App\Models\HealthFacility;

class HealthFacilityController extends Controller
{
    public function index() {
        $facilities = HealthFacility::all();
        $facilities = $facilities->each(function($item, $key){
            $item->name = $item->hf_name;
            unset($item->hf_name);
            $item->email = $item->hf_email;
            unset($item->hf_email);
            $item->contactNo = $item->hf_contact_no;
            unset($item->hf_contact_no);
            $item->level = $item->hf_level;
            unset($item->hf_level);
            $item->address = json_decode($item->hf_location);
            unset($item->hf_location);
        });
        return HealthFacilityResource::collection($facilities);
    }

    /**
     * Create new health facility
     */
    public function store(StoreHealthFacilityRequest $request)
    {
        try {
            $healthFacility = HealthFacility::create([
                "hf_name" => $request->name,
                "hf_email" => $request->email,
                "hf_contact_no" => $request->contactNo,
                "hf_level" => $request->level,
                "hf_location" => json_encode($request->address),
                "status" => 1,
                "created_by" => Auth()->user()->id
            ]);

            $success = true;
            $message = 'New Health Facility Created';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        // return response()->json($response);
        return new HealthFacilityResource($healthFacility);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(HealthFacility $facility)
    {
        return response()->json($facility);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreHealthFacilityRequest  $request
     * @param  \App\Models\HealthFacility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHealthFacilityRequest $request, $id)
    {
        $facility = HealthFacility::find($id);
        try {
            $facility->update([
                "hf_name" => $request->name,
                "hf_email" => $request->email,
                "hf_contact_no" => $request->contactNo,
                "hf_level" => $request->level,
                "hf_location" => json_encode($request->address),
                "status" => 1,
                "updated_by" => Auth()->user()->id
            ]);

            $success = true;
            $message = 'Health Facility Updated';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        
        return new HealthFacilityResource($facility);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthFacility $facility)
    {
        $facility->delete();

        return response(null, 204);
    }
}
