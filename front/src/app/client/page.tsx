"use client"

import React from "react"
import Layout from "../../app/layout"
import Customer from "@/components/Delivery/Customer";
import "../../styles/client.css"
import { Api } from "@/services/api"
import { SatisfiedCustomerDialog } from "@/components/Dialogs/SatisfiedCustomerDialog"

function Client() {
  return (
    <Layout>
      <SatisfiedCustomerDialog />
    </Layout>
  )
}

export default Client;