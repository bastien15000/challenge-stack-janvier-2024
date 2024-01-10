import React from "react";
import Select from 'react-select'


export const SelectBox: React.FC<SelectBoxProps> = (props) => {
  return (
    <div className="">
    <label className="MuiFormLabel-root MuiFormLabel-colorPrimary css-u4tvz2-MuiFormLabel-root">{props.label} :</label>
    <Select options={props.options}/>
    </div>
  )
}

export interface SelectBoxProps {
  label: string,
  options: Array<Object>,
}
