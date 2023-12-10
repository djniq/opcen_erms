import { AmbulanceState } from "@/models/AmbulanceModel";

export const state = () :AmbulanceState => {
    return {
        ambulances: [],
        loadingAmbulances: false,
        processingAmbulance: false
    }
}