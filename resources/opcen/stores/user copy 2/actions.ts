import { User } from "@/models/UserModel";

export const actions = {
    authenticate: (user: User) => {
        if (user && user.id) {
            this.user = user;
            this.isAuthenticated = true;
        }
    }
}