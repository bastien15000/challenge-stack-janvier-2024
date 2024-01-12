import React from "react";
import styled from "styled-components"
import Typography from "@mui/material/Typography"

export const BoxData: React.FC<BoxData> = (props) => {
  return (
    <DataContainer>
      <Typography variant="h6">{props.titre}</Typography>
      <p className="data-content">{props.content}</p>
    </DataContainer>
  )
}

export const DataContainer = styled.div`
    display: grid;
    grid-template-columns: 1FR 1FR;
    border-radius: 20px;
    background: #E81386;
    padding: 10px;
    justify-content: center;
    align-items: center;
    width: auto;
`

export interface BoxData {
  titre: string,
  content: string,
  id?: string,
}
