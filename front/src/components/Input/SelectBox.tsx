import React from "react";
import Select from 'react-select'
import { Input } from "@/components/Input/Input"

export const SelectBox: React.FC<SelectBoxProps> = (props) => {
  function handleAddrTypeChange(e: any, id: any) {
    let textLabel = "";
    switch (e.value) {
      case "Casse":
        textLabel = "Nombre de lot cassé ?";
        break
      case "Incomplet":
        console.log("incomplet")
        textLabel = "Combien vous manque t'il de lot de vaccin ?";
        break
      case "Retard":
        console.log("retard")
        textLabel = "combien de minutes de retard ?";
        break
    }
    if(textLabel != "") {
      let Quantite = document.getElementById(id + "-label");
      Quantite.textContent = textLabel;
    }
    
  }

  return (
    <div>
    <label className="MuiFormLabel-root MuiFormLabel-colorPrimary css-u4tvz2-MuiFormLabel-root">{props.label} :</label>
    <Select onChange={e => handleAddrTypeChange(e, props.id)} id={props.id} options={props.options}/>
    <br/>
    <Input id={props.id} label="Quantité" type="number"/>
    </div>
  )

}

export interface SelectBoxProps {
  label: string,
  id: string,
  options: Array<Object>,
}
