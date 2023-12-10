import { DriverState } from "@/models/DriverModel";

export const state = () :DriverState => {
    return {
        drivers: [],
        loadingDrivers: false,
        processingDriver: false
    }
}