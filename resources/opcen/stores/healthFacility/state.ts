import { FacilityState } from "@/models/FacilityModel";

export const state = () :FacilityState => {
    return {
        facilities: [],
        loadingFacilities: false
    }
}