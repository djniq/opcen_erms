import { IncidentState } from "@/models/IncidentModel";

export const state = () :IncidentState => {
    return {
        incidents: [],
        loadingIncidents: false,
        processingIncident: false
    }
}