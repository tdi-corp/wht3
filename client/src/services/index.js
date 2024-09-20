export const Services = {
    apiUrl: 'http://localhost:8000/api/post',
    PostsService(params = null) {
        const queryParams = params
            ? Object.keys(params)
                  .map((k) => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
                  .join('&')
            : '';
      
        return fetch(`${this.apiUrl}?` + queryParams).then((res) => res.json());
    },
    ShowService(id, params = null) {
        const queryParams = params
            ? Object.keys(params)
                  .map((k) => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
                  .join('&')
            : '';
      
        return fetch(`${this.apiUrl}/${id}?` + queryParams).then((res) => res.json());
    },
    async StoreService(data) {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
    
        return await fetch(`${this.apiUrl}`, {
            method: "POST",
            body: JSON.stringify(data),
            headers: myHeaders,
        })
        .then((res) => res.json());
    }    
}