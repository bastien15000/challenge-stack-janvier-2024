"use client"

import React from "react"
import StyledButtonComponent from "./StyledButton.styles"
import Button from "@mui/material/Button"

export const StyledButton = React.FC<PrimaryButtonProps> = (props) => {
  return (
    <StyledButtonComponent
      variant={props.variant}
      disableElevation
      $type={props.type}
    >
      {props.label}
    </StyledButtonComponent>
  )
}

export interface PrimaryButtonProps {
  label: string,
  variant: string,
  type: string,
}
