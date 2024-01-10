import styled, { css } from "styled-components"

const StyledButtonComponent = styled.button<StyledButtonComponentProps>`
   ${({ theme, $type }) => css`
      color: white;
      padding: 3% 2%;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      
      ${$type === "primary" && css`
         background-color: ${theme.colors.pink};
         &:hover {
            background-color: ${theme.colors.darkPink};
         }
      `}
      
      ${$type === "secondary" && css`
         color: ${theme.colors.pink};
         border: 1px solid;
         background-color: transparent;
         &:hover {
            background-color: whitesmoke;
         }
      `}
   `}
   `

export interface StyledButtonComponentProps {
   $type: "primary" | "secondary",
}

export default StyledButtonComponent;