
import axios from "axios";

const baseDomain = "http://127.0.0.1:8000";

// ALL DEFUALT CONFIGURATION HERE 

export default axios.create({ 
    baseDomain,
    headers: {
        "Content-Type": "multipart/form-data;"
    }
});