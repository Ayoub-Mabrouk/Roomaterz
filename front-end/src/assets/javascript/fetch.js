export default {
    async auth(url , form) {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "accept": "application/json",
            },
            body: JSON.stringify(form)
        });

        const data = await response.json();
        return data;
    },
    async post(url ,form,token ){
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "accept": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(form)
        });
        const data = await response.json();
        return data;
    }
}