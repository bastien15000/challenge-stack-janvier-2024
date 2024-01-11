"use client"

import * as React from 'react'
import Button from '@mui/material/Button'
import { styled } from '@mui/material/styles'
import Dialog from '@mui/material/Dialog'
import IconButton from '@mui/material/IconButton'
import CloseIcon from '@mui/icons-material/Close'
import Typography from '@mui/material/Typography'
import { StyledButton } from "@/components/Button/StyledButton"
import { SelectBox } from "@/components/Input/SelectBox"
import FormControl from '@mui/material/FormControl'
import Rating from '@mui/material/Rating'

const BootstrapDialog = styled(Dialog)(({ theme }) => ({
  '& .MuiDialogContent-root': {
    padding: theme.spacing(2),
  },
  '& .MuiDialogActions-root': {
    padding: theme.spacing(1),
  },
}));

export const SatisfiedCustomerDialog = React.FC = () => {
  const [open, setOpen] = React.useState(false)
  const [value, setValue] = React.useState<number | null>(2)
  const options = [{ value: 'Casse', label: 'Unité cassé' },{ value: 'Incomplet', label: 'Livraison incompléte' },{ value: 'Retard', label: 'Livraison en retard' }];
  const handleClickOpen = () => {
    setOpen(true)
  }
  const handleClose = () => {
    setOpen(false)
  }

  return (
    <React.Fragment>
      <Button variant="outlined" onClick={handleClickOpen}>
        Open satisfied customer dialog
      </Button>
      <BootstrapDialog
        onClose={handleClose}
        aria-labelledby="customized-dialog-title"
        open={open}
      >
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
          <div id="ObservationBlock">
            <SelectBox id="Observation1" label="Observation" options={options}/>
            <br/> 
            <SelectBox id="Observation2" label="Observation" options={options}/>
          </div>

          <FormControl>
            
            
            <br/>
            <Typography component="legend">Note du livreur</Typography>
            <Rating
              name="simple-controlled"
              value={value}
              onChange={(event, newValue) => {
                setValue(newValue);
              }}
            />
          </FormControl>

          <br/>
          <StyledButton label="Valider" type="primary"/>
        </div>
      </BootstrapDialog>
    </React.Fragment>
  )
}
