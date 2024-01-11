import React from "react";
import PinkBorderTextField from "./Input.styles"

export const Input: React.FC<InputProps> = (props) => {
  return (
    <div>ceci est notre input</div>
  )
}

export interface InputProps {
  label: string,
  type: string,
  id?: string,
}
