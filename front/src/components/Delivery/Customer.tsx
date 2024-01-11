"use client"

import React from "react"

function Customer(props: { data: any }) {
    return (
        <div className="client-delivery">
            <div className="client-info">
                <img src={`${props.data.img_src}`} alt="" />
                <div>
                    <p>{props.data.name}</p>
                    <p>N°{props.data.num}</p>
                </div>
            </div>
            <div className="state">
                <div className={`state-circle ${props.data.state}`}></div>
            </div>
            <div>
                <p>{props.data.address}</p>
            </div>
            <div>
                <p>{props.data.date}</p>
            </div>
        </div>
    )
}

export default Customer;