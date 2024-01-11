"use client"

import React from "react"
import StyledButtonComponent from "./StyledButton.styles"

export const StyledButton = React.FC<PrimaryButtonProps> = (props) => {
  return (
    <StyledButtonComponent
      // disableElevation
      $type={props.type}
      $width={props.width}
    >
      {props.label}
    </StyledButtonComponent>
  )
}

export interface PrimaryButtonProps {
  label: string,
  type: string,
  width?: number,
}
