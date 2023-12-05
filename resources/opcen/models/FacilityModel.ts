export interface FacilityState {
    facilities: Facility[];
    loadingFacilities: boolean;
    processingFacility: boolean;
}

export interface Facility {
    id?: number;
    name?: string;
    address?: google.maps.Map;
    email?: string;
    contactNo?: string;
    status?: number;
    level?: string;
}

