"use client"

import { ThemeProvider } from 'styled-components'
import themes from "../styles/themes"
import Login from "@/pages/login"
import Dashboard from './dashboard'
import { CancelDialog } from "@/components/Dialogs/CancelDialog"
import { DeliveryReports } from "@/components/Dialogs/DeliveryReports"
import { SatisfiedCustomerDialog } from "@/components/Dialogs/SatisfiedCustomerDialog"

function App() {
  return (
    <ThemeProvider theme={themes}>
      {/*<Login/>*/} {/*juste pour tester, à enlever et à trovuer comment faire le systeme de root*/}
      <Dashboard />
      <CancelDialog />
      <DeliveryReports />
      <SatisfiedCustomerDialog />
    </ThemeProvider>
  )
}

export default App
