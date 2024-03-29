"use client"

import * as React from 'react'
import Button from '@mui/material/Button'
import { styled } from '@mui/material/styles'
import Dialog from '@mui/material/Dialog'
import DialogTitle from '@mui/material/DialogTitle'
import DialogContent from '@mui/material/DialogContent'
import DialogActions from '@mui/material/DialogActions'
import IconButton from '@mui/material/IconButton'
import CloseIcon from '@mui/icons-material/Close'
import Typography from '@mui/material/Typography'
import { StyledButton } from "@/components/Button/StyledButton"
import { Input } from "@/components/Input/Input"

const BootstrapDialog: React.FC<CancelDialogDialogProps> = styled(Dialog)(({ theme }) => ({
  '& .MuiDialogContent-root': {
    padding: theme.spacing(2),
  },
  '& .MuiDialogActions-root': {
    padding: theme.spacing(1),
  },
}));

export const CancelDialog = React.FC = (props) => {
  return (
    <React.Fragment>
      <BootstrapDialog
        handleClickOpen={props.handleClickOpen}
        handleClose={props.handleClose}
        onClose={props.onClose}
        isOpen={props.isOpen}
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
          <Typography variant="h5" gutterBottom>Annuler la livraison</Typography>
          <IconButton
            aria-label="close"
            onClick={handleClose}
            sx={{
              position: 'absolute',
              right: 8,
              top: 8,
              // color: (theme) => theme.palette.grey[500], à definir
            }}
          >
            <CloseIcon/>
          </IconButton>
          <Input label="Laissez un commentaire" type="text"/>
          <br/>
          <Button variant="contained" type="submit">Valider</Button>
        </div>
      </BootstrapDialog>
    </React.Fragment>
  )
}

export interface CancelDialogDialogProps {
  isOpen: boolean,
  handleClickOpen: () => void,
  handleClose: () => void,
}
