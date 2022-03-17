import {postApi} from "./tools";

const search = {
    requestVehicle: async (seats, origin_address, destination_address, tk) => {
        return await postApi("request-vehicle", {seats, origin_address, destination_address}, tk)
    },
}

export default search;
