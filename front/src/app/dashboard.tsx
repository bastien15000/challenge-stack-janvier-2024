import React, { useState } from "react"
import "./../styles/dashboard.css"
import styled from "styled-components"
import Typography from "@mui/material/Typography"
import { Divider } from "@mui/material"
import CurveChart from "@/components/Graphs/curveChart"
import { BoxData } from "@/components/Graphs/boxData"
import DoubleBar from "../components/Graphs/doubleBar"
import { Api } from "@/services/api"

const Dashboard: React.FC<DashboardProps> = (props) => {
  const [info, setInfos] = useState([]) // Initialisation de l'état
  Api.ajax("kpi/serviceRate", "GET")
    .then(data => {
      var perDays = data.content.perDays
      perDays = perDays.map((perDay) => perDay / 100)
      setInfos(perDays) // Mise à jour de l'état avec les nouvelles données
    })
  return (
    <div>
      <DataContainer>
        <div style={{
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
        }}>
          <Typography variant="h5">Taux de service</Typography>
        </div>
        <br />
        <Divider light />
        <br />
        <ContentsContainer>
          <div>
            <CurveChart
              labels={['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', "Sam", "Dim"]}
              data={[0, 100, 50, 30, 40, 50, 40, 30, 70, 80, 25, 40]}
              // data={info}
              tension={0.5}
              borderColor="#E81386"
              backgroundColor="#E81386"
            />
          </div>
          <MetricsData>
            <BoxData content="163" titre="Total des commandes" />
            <BoxData content="141" titre="Total des commandes livrée" />
            <BoxData content="87" titre="Pourcentage livrée par jours" />
          </MetricsData>
        </ContentsContainer>
      </DataContainer>

      <br />
      <br />


      <DataContainer>
        <div style={{
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
        }}>
          <Typography variant="h5">Indice de Performance Logistique</Typography>
        </div>
        <br />
        <Divider light />
        <br />
        <ContentsContainer>
          <div>
            <CurveChart
              labels={['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', "Sam", "Dim"]}
              data={[0, 100, 40, 50, -40, -30, 50]}
              tension={0.5}
              borderColor="#E81386"
              backgroundColor="#E81386"
            />
          </div>
          <MetricsData>
            <BoxData content="80%" titre="Satisfaction client" />
            <BoxData content="150€" titre="Cout moyen par livraison" />
            <BoxData content="17L" titre="Efficacité énergétique" />
          </MetricsData>
        </ContentsContainer>
      </DataContainer>
      <br />
      <br />

      <DataContainer>
        <div style={{
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
        }}>
          <Typography variant="h5">Consommation de carburants pour 100 km par type de véhicule</Typography>
        </div>
        <br />
        <Divider light />
        <br />
        <ContentsContainer>
          <div>
            <DoubleBar
              labels={['Iveco', 'Mercedes', 'Volkswagen', 'ISUZU']}
              data={[15, 30, 10, 20]}
              tension={0.5}
              borderColor="#E81386"
              backgroundColor="#E81386"
            />
          </div>
          <MetricsData>
            <BoxData content="15L" titre="Consomamtion moyenne" />
            <BoxData content="14L" titre="Consommation théorique moyenne" />
          </MetricsData>
        </ContentsContainer>
      </DataContainer>
    </div>
  )
}

export const DataContainer = styled.div`
    display: flex;
    flex-direction: column;
    width: 100rem;
    height: auto;
    padding: 1rem 3rem;
    background-color: white;
    border-radius: 1rem;
    align-content: center;
`

export const ContentsContainer = styled.div`
    display: grid;
    grid-template-columns: 60% 40%;
`

export const MetricsData = styled.div`
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1rem;
    margin-top: 4rem;
`

export interface DashboardProps {
  title: string,
}

export default Dashboard