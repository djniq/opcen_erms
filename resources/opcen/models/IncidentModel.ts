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
    categoryLabel?: string;
    vicinity: string;
    vicinityLabel?: string;
    fromHealthFacilityId?: number|'self';
    from_health_facility?: any;
    toHealthFacilityId?: number|'self';
    to_health_facility?: any;
    origin: any|null;
    destination: any|null;
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