import { Facility } from "./FacilityModel";

export interface User {
    id?: number;
    name?: string;
    username?: string
    email?: string;
    mobile?: string;
    role?: string|number;
    facility?: Facility;
    permissions?: string[];
}

export interface UserState {
    user: User;
    isAuthenticated: boolean;
}

