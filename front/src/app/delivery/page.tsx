"use client"

import React from "react"
import Layout from "../../app/layout"
import Customer from "@/components/Delivery/Customer";
import "../../styles/client.css"
import { Api } from "@/services/api"

function Delivery() {
  Api.ajax("orders", "GET")
    .then(data => {
      console.log(data.content)
    })
  return (
    <Layout>
      <div className="client-list">
        <Customer data={{
          img_src: "/Theraputics.png",
          name: "McDonalds",
          num: 432990,
          state: "green",
          address: "2 rue du nord",
          date: "6/3/22"
        }} />
        <Customer data={{
          img_src: "/Theraputics.png",
          name: "McDonalds",
          num: 432990,
          state: "orange",
          address: "2 rue du nord",
          date: "6/3/22"
        }} />
      </div>
    </Layout>
  )
}

export default Delivery;