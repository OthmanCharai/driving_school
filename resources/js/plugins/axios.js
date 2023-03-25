import axios from "axios";

const config = {
    baseURL: "/api",
    withCredentials: true,
};

const axiosIns = axios.create(config);

export default axiosIns;
