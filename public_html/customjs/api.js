const BASE_API="/salondebelleza/";

class Api {
    async post(data,url) {
        const query=await fetch(`${BASE_API}${url}`,{
            method:"post",
            body:data
        });
        const json=await query.json();
        return json;
    }

    async get(url) {
        const query=await fetch(`${BASE_API}${url}`);
        const json=await query.json();
        return json;
    }
    
}