"use client"

import React from "react"

function Customer(props: { data: any }) {
    const formatDate = (dateString: string) => {
        const options: Intl.DateTimeFormatOptions = { day: 'numeric', month: 'short', year: 'numeric' };
        const formattedDate = new Date(dateString).toLocaleDateString(undefined, options);

        return formattedDate.replace(/\d+/, (match) => match);
    };

    return (
        <div className="client-delivery">
            <div className="client-info">
                <img src={`${props.data.img_src}`} alt=""/>
                <div>
                    <p>{props.data.phone}</p>
                    <p>N°{props.data.num}</p>
                </div>
            </div>
            <div className="order-state">
                <p>{props.data.state}</p>
            </div>
            <div className="client-address">
                <p>{props.data.address}</p>
            </div>
            <div className="order-expected-time">
                <p>{formatDate(props.data.date)}</p>
            </div>
            <div className="order-actions">
                <p>{props.data.actions}</p>
            </div>
        </div>
    )
}

export default Customer;