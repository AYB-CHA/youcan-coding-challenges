import Axios from "axios";

const axios = Axios.create({
    baseURL: import.meta.env["VITE_BACKEND_BASEURL"],
    headers: {
        "Accept": "application/json",
    },
    // withCredentials: true,
});

export default axios;