import { UserState } from "@/models/UserModel";

export const state = () :UserState => {
    return {
        user: {},
        isAuthenticated: false
    }
}