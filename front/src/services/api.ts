export const Api = {
    ajax: function (route: any, action: any) {
        return fetch("localhost:8000/api/" + route, {
            method: action,
            headers: { 'Content-Type': 'application/json' }
        }).then(response => response.json()).then(data => console.log(data))
    }
}