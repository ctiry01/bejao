import {postApi} from "./tools";

const user = {
    login: async (email, password) => {
        return await postApi("login", {email, password})
    },

    logout: async () => {
        return await postApi("logout", {})
    },

    register: async (name, email, password, origin_address, destination_address, brand, model, seats, fuel_consumption) => {
        return await postApi("register", {name, email, password, origin_address, destination_address, brand, model, seats, fuel_consumption})
    },

    vehicle: async (brand, model, seats, fuel_consumption, tk) => {
        return await postApi("vehicle", {brand, model, seats, fuel_consumption}, tk)
    },
}

export default user;
