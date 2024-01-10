import styled, { css } from "styled-components"
import TextField from "@mui/material/TextField"

const PinkBorderTextField = styled(TextField)`
    & .MuiOutlinedInput-root {
        fieldset {
            border-color: ${({ theme }) => theme.colors.pink}; // Utilisez votre couleur thématique ici
            color: ${({ theme }) => theme.colors.pink}
        }
        &:hover fieldset {
            border-color: ${({ theme }) => theme.colors.pink}; // Pour l'état hover également
            color: ${({ theme }) => theme.colors.pink}
        }
        &.Mui-focused fieldset {
            border-color: ${({ theme }) => theme.colors.pink}; // Pour l'état focus
            color: ${({ theme }) => theme.colors.pink}
        }
    }
`;

export default PinkBorderTextField;
