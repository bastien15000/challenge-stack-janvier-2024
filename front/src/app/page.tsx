"use client"

import Graph from './graph'
import { ThemeProvider } from 'styled-components';
import themes from '../styles/themes';
import { Input } from "@/components/Input/Input"
import { StyledButton } from "@/components/Button/StyledButton"

function App() {
  return (
    <ThemeProvider theme={themes}>
      <Input label="label input"/>
      <br/>
      <br/>
      <br/>
      <StyledButton label="label test" variant="contained" type="secondary"/>
      <br/>
      <br/>
      <Graph />
    </ThemeProvider>
  )
}

export default App
