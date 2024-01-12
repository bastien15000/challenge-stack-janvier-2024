"use client"

import React, { useEffect, useState } from "react"
import Layout from "../../app/layout"
import Customer from "@/components/Delivery/Customer";
import "../../styles/client.css"
import { Api } from "@/services/api"
import { Chip } from "@mui/material"
import IconButton from '@mui/material/IconButton';
import DeleteIcon from '@mui/icons-material/Delete';

function Delivery() {
  const [delivery, setDelivery] = useState([])

  useEffect(() => {
    Api.ajax("deliveries/deliveryman/1578", "GET")
      .then(data => {
        setDelivery(data.content)
      })

  }, [])

  console.log(delivery.date)
  console.log(delivery.orders)

  return (
    <Layout>
      <div className="client-list">
        <div className="client-delivery">
          <div className="client-info">
            <Chip label="Entreprise" sx={{ fontSize: "1.1rem", padding: "1rem" }} />
          </div>
          <div className="order-state">
            <Chip label="Statut" sx={{ fontSize: "1.1rem", padding: "1rem" }} />
          </div>
          <div className="client-address">
            <Chip label="Adresse" sx={{fontSize: "1.1rem", padding: "1rem"}}/>
          </div>
          <div className="order-expected-time">
            <Chip label="Date de livraison" sx={{fontSize: "1.1rem", padding: "1rem"}}/>
          </div>
          <div className="order-actions">
            <Chip label="Actions" sx={{fontSize: "1.1rem", padding: "1rem"}}/>
          </div>
        </div>
        {
          delivery?.orders?.map(function (order : any) {
            return <Customer data={{
              img_src: "/Theraputics.png",
              phone: order.customer.phone,
              num: order?.id,
              state: order.state,
              address: `${order.customer.address} - ${order.customer.complement} - ${order.customer.zipcode}`,
              date: order.expected_time,
              actions: (
                <IconButton aria-label="delete" size="large" onClick={() => console.log("je viens de supprimer cette livraison")}>
                  <DeleteIcon fontSize="inherit" sx={{ color: "red" }} />
                </IconButton>
              )
            }} />
          })
        }
      </div>
    </Layout>
  )
}

export default Delivery;