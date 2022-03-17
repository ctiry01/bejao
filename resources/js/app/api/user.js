import {postApi} from "./tools";

const user = {
    login: async (email, password) => {
        return await postApi("login", {email, password})
    },

    register: async (name, email, password) => {
        return await postApi("register", {name, email, password})
    },
}

export default user;
