import {postApi} from "./tools";

const user = {
    login: async (email, password) => {
        return await postApi("login", {email, password})
    },

    logout: async () => {
        return await postApi("logout", {})
    },

    register: async (name, email, password) => {
        return await postApi("register", {name, email, password})
    },
}

export default user;
