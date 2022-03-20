import {postApi} from "./tools";

const search = {
    requestVehicle: async (origin_address, destination_address, tk) => {
        return await postApi("request-vehicle", {origin_address, destination_address}, tk)
    },
}

export default search;
