"use client"

import Dashboard from './dashboard'
import styled from "styled-components"

function App() {
  return (
    <Container>
      <Dashboard title="ceci est le titre d'un truc"/>
    </Container>
  )
}

export const Container = styled.div`
    width: 100%;
    height: auto;
    padding: 2rem;
    background-color: #FFF5E1;
    border-radius: 1rem;
    display: flex;
    justify-content: center;
`

export default App
