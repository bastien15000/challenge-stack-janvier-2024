import React from "react";
import PinkBorderTextField from "./Input.styles"

export const Input: React.FC<InputProps> = (props) => {
  return (
    <PinkBorderTextField label={props.label}/>
  )
}

export interface InputProps {
  label: string,
}
