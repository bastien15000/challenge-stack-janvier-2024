"use client"

import * as React from 'react'
import Button from '@mui/material/Button'
import IconButton from '@mui/material/IconButton'
import CloseIcon from '@mui/icons-material/Close'
import Typography from '@mui/material/Typography'
import { SelectBox } from "@/components/Input/SelectBox"
import FormControl from '@mui/material/FormControl'
import Rating from '@mui/material/Rating'
import styled from "styled-components"

export const SatisfiedCustomerDialog = React.FC = () => {
  const [open, setOpen] = React.useState(false)
  const [value, setValue] = React.useState<number | null>(2)
  const [value2, setValue2] = React.useState<number | null>(2)
  const options = [{ value: 'Casse', label: 'Unité cassé' },{ value: 'Incomplet', label: 'Livraison incompléte' },{ value: 'Retard', label: 'Livraison en retard' }];
  const handleClickOpen = () => {
    setOpen(true)
  }
  const handleClose = () => {
    setOpen(false)
  }

  return (
    <React.Fragment >
      <Container id="Client">
        <div style={{
          height: "100%",
          margin: "3rem",
          display: "flex",
          flexDirection: "column",
          gap: "1rem"
        }}>
          <Typography variant="h5" gutterBottom>Compte rendu de la livraison</Typography>
          <IconButton
            aria-label="close"
            onClick={handleClose}
            sx={{
              position: 'absolute',
              right: 8,
              top: 8,
              color: (theme) => theme.palette.grey[500],
            }}
          >
            <CloseIcon/>
            
          </IconButton>
          <FormControl>
            <br/>
            <Typography component="legend">Êtes-vous satisfait de votre livraison ?</Typography>
            <Rating
              name="simple-controlled"
              value={value}
              onChange={(event, newValue) => {
                if (newValue >= 3) {
                  // Correction du bug 5 etoiles sur 4
                  if (newValue == 5) {newValue = 4}
                  document.getElementById("ObservationBlock").classList.add("hidden")
                }
                // Si la note est inférieur a 3 on affiche le formulaire de mécontentement
                else if(newValue < 3 && newValue != null) {
                  document.getElementById("ObservationBlock").classList.remove("hidden")
                }

                setValue(newValue);
              }}
            />
          </FormControl>
          <div id="ObservationBlock" class="hidden">
            <SelectBox id="Observation1" label="Observation" options={options}/>
            <br/> 
            <SelectBox id="Observation2" label="Observation" options={options}/>
          </div>
          <FormControl>
            <br/>
            <Typography component="legend">Note du livreur</Typography>
            <Rating
              name="simple-controlled2"
              value={value2}
              onChange={(event, newValue2) => {
                if (newValue2 == 5) {newValue2 = 4}
                setValue2(newValue2);
              }}
            />
          </FormControl>
          

          <br/>
          <Button variant="contained" type="submit">Valider</Button>
        </div>
      </Container>
    </React.Fragment>
  )
}

export const Container = styled.div`
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: auto;
    border-radius: 1rem;
    padding: 3rem;
    border: 0.2rem solid whitesmoke;
`
