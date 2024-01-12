"use client"

import React, { useState } from "react"
import Paper from "@mui/material/Paper"
import styled, { css } from "styled-components"
import Typography from '@mui/material/Typography'
import { Input } from "@/components/Input/Input"
import Button from "@mui/material/Button"
import { Api } from "@/services/api"
import { TextField } from "@mui/material"

function Login() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  const handleUsernameChange = (event) => {
    setUsername(event.target.value);
  };

  const handlePasswordChange = (event) => {
    setPassword(event.target.value);
  };

  const handleSubmit = () => {
    Api.login({
      username: username,
      password: password,
    });
  };

  return (
    <Container>
      <PaperContainer elevation={3}>
        <Typography variant="h4" gutterBottom>Login</Typography>
        <TextField
          id="outlined-basic"
          label="Identifiant"
          variant="outlined"
          type="text"
          color="primary"
          onChange={handleUsernameChange}
        />
        <TextField
          id="outlined-basic"
          label="Mot de passe"
          variant="outlined"
          type="password"
          color="primary"
          onChange={handlePasswordChange}
        />
        <Button variant="contained" type="submit" size="large" onClick={handleSubmit}>Connexion</Button>
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
