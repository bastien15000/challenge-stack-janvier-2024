"use client"

import Dashboard from './dashboard'
import { CancelDialog } from "@/components/Dialogs/CancelDialog"
import { DeliveryReports } from "@/components/Dialogs/DeliveryReports"
import { SatisfiedCustomerDialog } from "@/components/Dialogs/SatisfiedCustomerDialog"

function App() {
  return (
    <>
      <Dashboard />
      <CancelDialog />
      <DeliveryReports />
    </>
  )
}

export default App
