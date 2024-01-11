"use client"

import React from "react"
import Paper from "@mui/material/Paper"
import styled, { css } from "styled-components"
import Typography from '@mui/material/Typography'
import { Input } from "@/components/Input/Input"
import Button from "@mui/material/Button"

function Login() {
  return (
    <Container>
      <PaperContainer elevation={3}>
        <Typography variant="h4" gutterBottom>Login</Typography>
        <Input label="Identifiant" type="text" />
        <Input label="Mot de passe" type="password" />
        <Button variant="contained" type="submit" size="large">Connextion</Button>
      </PaperContainer>
    </Container>
  )
}

export const Container = styled.div`
    margin-top: 5rem;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
`;

export const PaperContainer = styled(Paper)`
    display: flex;
    flex-direction: column;
    gap: 2rem;
    padding: 5rem;
    height: auto;
    width: 25%;
`;

export default Login;
