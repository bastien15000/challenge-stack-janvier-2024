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
  const [orders, setOrders] = useState([]) // Initialisation de l'état

  useEffect(() => {
    Api.ajax("orders", "GET")
      .then(data => {
        setOrders(data.content) // Mise à jour de l'état avec les nouvelles données
      })
  }, [])

  return (
    <Layout>
      <div className="client-list">
        <div className="client-delivery">
          <div className="client-info">
            <Chip label="Entreprise" sx={{ fontSize: "1.1rem", padding: "1rem" }} />
          </div>
          <div className="state">
            <Chip label="Statut" sx={{ fontSize: "1.1rem", padding: "1rem" }} />
          </div>
          <div>
            <Chip label="Adresse" sx={{ fontSize: "1.1rem", padding: "1rem" }} />
          </div>
          <div>
            <Chip label="Date de livraison" sx={{ fontSize: "1.1rem", padding: "1rem" }} />
          </div>
          <div>
            <Chip label="Actions" sx={{ fontSize: "1.1rem", padding: "1rem" }} />
          </div>
        </div>
        {
          orders?.map(function (order) {
            return <Customer data={{
              img_src: "/Theraputics.png",
              name: "McDonalds",
              num: order?.id,
              state: "green",
              address: "2 rue du nord",
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