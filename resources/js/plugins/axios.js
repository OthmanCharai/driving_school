import axios from "axios";

const config = {
    baseURL: "/api",
    withCredentials: true,
    headers: {
        Authorization:
            "Bearer ",
    },
};

const axiosIns = axios.create(config);

export default axiosIns;
