import { redirect } from 'next/navigation'

export const Api = {
    login: function (auth: any) {
        return fetch("http://localhost:8000/api/login", {
            method: "POST",
            body: JSON.stringify(auth),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.roles.includes("ROLE_MANAGER")) {
                    // redirect("/")
                    window.location.href = "/"
                } else if (data.roles.includes("ROLE_DELIVERYMAN")) {
                    // redirect("/delivery")
                    window.location.href = "/delivery"
                } else if (data.roles.includes("ROLE_CLIENT")) {
                    // redirect("/client")
                    window.location.href = "/client"
                }

            })
    },
    ajax: function (route: any, action: any) {
        return fetch("http://localhost:8000/api/" + route, {
            method: action,
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            }
        }).then(response => response.json())
    }
}