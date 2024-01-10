import React from "react";
import PinkBorderTextField from "./Input.styles"

export const Input: React.FC<InputProps> = (props) => {
  return (
    <PinkBorderTextField id={props.id} label={props.label} type={props.type}/>
  )
}

export interface InputProps {
  label: string,
  type: string,
  id?: string,
}
