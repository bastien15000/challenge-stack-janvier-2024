"use client"

import React from "react"
import StyledButtonComponent from "./StyledButton.styles"

export const StyledButton = React.FC<PrimaryButtonProps> = (props) => {
  return (
    <div>ceci est le bouton</div>
  )
}

export interface PrimaryButtonProps {
  label: string,
  type: string,
  width?: number,
}
