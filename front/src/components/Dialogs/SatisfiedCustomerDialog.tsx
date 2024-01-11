"use client"

import Button from '@mui/material/Button'
import IconButton from '@mui/material/IconButton'
import CloseIcon from '@mui/icons-material/Close'
import Typography from '@mui/material/Typography'
import {SelectBox} from "@/components/Input/SelectBox"
import FormControl from '@mui/material/FormControl'
import Rating from '@mui/material/Rating'
import styled from "styled-components"
import React from "react";

export const SatisfiedCustomerDialog: React.FC = () => {
    const [open, setOpen] = React.useState(false)
    const [deliveryRatingNumber, setDeliveryRatingNumber] = React.useState<number | null>(10)
    const [deliverymanRatingNumber, setDeliverymanRatingNumber] = React.useState<number | null>(10)
    const options = [
        {value: 'Casse', label: 'Unité cassé'},
        {value: 'Incomplet', label: 'Livraison incompléte'},
        {value: 'Retard', label: 'Livraison en retard'}
    ];

    const handleClickOpen = () => {
        setOpen(true)
    }
    const handleClose = () => {
        setOpen(false)
    }

    return (
        <React.Fragment>
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
                            name="delivery_rate"
                            value={deliveryRatingNumber}
                            max={10}
                            size="large"
                            onChange={(event, value) => setDeliveryRatingNumber(value)}
                        />
                    </FormControl>

                    {((deliveryRatingNumber ?? 0) <= 5 ) && (
                        <div id="ObservationBlock">
                            <SelectBox id="Observation1" label="Observation 1" options={options}/>
                            <br/>
                            <SelectBox id="Observation2" label="Observation 2" options={options}/>
                        </div>
                    )}

                    <FormControl>
                        <br/>
                        <Typography component="legend">Note du livreur</Typography>
                        <Rating
                            name="deliveryman_rate"
                            value={deliverymanRatingNumber}
                            max={10}
                            size="large"
                            onChange={(event, value) => setDeliverymanRatingNumber(value)}
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
