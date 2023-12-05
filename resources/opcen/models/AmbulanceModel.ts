export interface AmbulanceState {
    ambulances: Ambulance[];
    loadingAmbulances: boolean;
    processingAmbulance: boolean;
}

export interface Ambulance {
    id?: number;
    healthFacilityId?: number;
    type?: string;
    plateNo?: string;
    status?: number;
}

