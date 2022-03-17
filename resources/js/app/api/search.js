import {postApi} from "./tools";

const search = {
    requestVehicle: async (seats, origin, destination) => {
        return await postApi("request-vehicle", {seats, origin, destination})
    },
}

export default search;
