"use client"

import * as React from 'react'
import Button from '@mui/material/Button'
import { styled } from '@mui/material/styles'
import Dialog from '@mui/material/Dialog'
import IconButton from '@mui/material/IconButton'
import CloseIcon from '@mui/icons-material/Close'
import Typography from '@mui/material/Typography'
import { StyledButton } from "@/components/Button/StyledButton"
import { Input } from "@/components/Input/Input"

const BootstrapDialog = styled(Dialog)(({ theme }) => ({
  '& .MuiDialogContent-root': {
    padding: theme.spacing(2),
  },
  '& .MuiDialogActions-root': {
    padding: theme.spacing(1),
  },
}));

export const DeliveryReports = React.FC = () => {
  const [open, setOpen] = React.useState(false)

  const handleClickOpen = () => {
    setOpen(true)
  }
  const handleClose = () => {
    setOpen(false)
  }

  return (
    <React.Fragment>
      <Button variant="outlined" onClick={handleClickOpen}>
        Open delivery reports dialog
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
          <Input label="Kilometrage" type="number"/>
          <Input label="Facture essences" type="number"/>
          <Input label="Prix peages" type="number"/>
          <Input label="Commentaire" type="number"/>
          <br/>
          <StyledButton label="Valider" type="primary"/>
        </div>
      </BootstrapDialog>
    </React.Fragment>
  )
}
