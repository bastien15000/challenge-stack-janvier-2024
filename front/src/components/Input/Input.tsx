import React from "react";
import TextField from "@mui/material/TextField"

export const Input: React.FC<InputProps> = (props) => {
  return (
    <TextField
      id={props.id}
      label={props.label}
      variant="outlined"
      type={props.type}
      color="primary"
    />
  )
}

export interface InputProps {
  label: string,
  type: string,
  id?: string,
}
