export interface DriverState {
    drivers: Driver[];
    loadingDrivers: boolean;
    processingDriver: boolean;
}

export interface Driver {
    id?: number;
    healthFacilityId?: number;
    healthFacilityName?: string;
    firstName?: string;
    lastName?: string;
    middleName?: string|null;
    status?: number;
    statusLabel?: string;
}

