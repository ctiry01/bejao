import {postApi} from "./tools";

const user = {
    login: async  (email, password) => {
        return await postApi("login", {email, password})
    },

}

export default user;
