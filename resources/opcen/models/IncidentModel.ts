export interface IncidentState {
    incidents: Incident[];
    loadingIncidents: boolean;
    processingIncident: boolean;
}

export interface Incident {
    id?: number;
    healthFacilityId?: number;
    reportedDatetime?: string;
    nature: string;
    category: string;
    vicinity: string;
    fromHealthFacilityId?: number|'self';
    toHealthFacilityId?: number|'self';
    origin: google.maps.Map|null;
    destination: google.maps.Map|null;
    status?: number;
    statusLabel?: string;
    patientEhrId?: string;
    patientFirstName: string;
    patientLastName: string;
    patientMiddleName?: string;
    patientBirthdate: string;
    patientAddress: string;
    chiefComplaint: string;
    remarks?: string;
}