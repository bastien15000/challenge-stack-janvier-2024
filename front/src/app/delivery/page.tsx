"use client"

import React, { useEffect, useState } from "react"
import Layout from "../../app/layout"
import Customer from "@/components/Delivery/Customer";
import "../../styles/client.css"
import { Api } from "@/services/api"

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
        {
          orders?.map(function (order) {
            return <Customer data={{
              img_src: "/Theraputics.png",
              name: "McDonalds",
              num: order?.id,
              state: "green",
              address: "2 rue du nord",
              date: order.expected_time
            }} />
          })
        }
      </div>
    </Layout>
  )
}

export default Delivery;