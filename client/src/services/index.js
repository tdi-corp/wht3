export const Services = {

    PostsService(params = null) {
        const queryParams = params
            ? Object.keys(params)
                  .map((k) => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
                  .join('&')
            : '';
      
        return fetch('http://localhost:8000/api/post?' + queryParams).then((res) => res.json());
    },
    ShowService(id, params = null) {
        const queryParams = params
            ? Object.keys(params)
                  .map((k) => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
                  .join('&')
            : '';
      
        return fetch(`http://localhost:8000/api/post/${id}?` + queryParams).then((res) => res.json());
    },
    async StoreService(data) {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
    
        return await fetch('http://localhost:8000/api/post', {
            method: "POST",
            body: JSON.stringify(data),
            headers: myHeaders,
        })
        .then((res) => res.json());
    }    
}