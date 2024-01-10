"use client"

import React from "react"
import Paper from "@mui/material/Paper"
import styled, { css } from "styled-components"
import Typography from '@mui/material/Typography'
import { Input } from "@/components/Input/Input"
import { StyledButton } from "@/components/Button/StyledButton"

function Login() {
  return (
    <Container>
      <PaperContainer elevation={3}>
        <Typography variant="h4" gutterBottom>Login</Typography>
        <Input label="Identifiant" type="text"/>
        <Input label="Mot de passe" type="password"/>
        <StyledButton label="Connexion" type="primary"/>
      </PaperContainer>
    </Container>
  )
}

export const Container = styled.div`
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
`;

export const PaperContainer = styled(Paper)`
    display: flex;
    flex-direction: column;
    gap: 2rem;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    height: 30rem;
    width: 40%;
`;

export default Login;
