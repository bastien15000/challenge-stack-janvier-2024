import React from "react"
import "./../styles/dashboard.css"
import styled from "styled-components"
import Typography from "@mui/material/Typography"
import { Divider } from "@mui/material"
import CurveChart from "@/components/Graphs/curveChart"
import { BoxData } from "@/components/Graphs/boxData"
import DoubleBar from "../components/Graphs/doubleBar"

const Dashboard: React.FC<DashboardProps> = (props) =>  {
    return (
      <div>
        <DataContainer>
          <div style={{
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
          }}>
            <Typography variant="h5">{props.title}</Typography>
          </div>
          <br/>
          <Divider light/>
          <br/>
          <ContentsContainer>
            <div>
              <CurveChart
                labels={['Jan', 'Feb', 'Mar', 'Apr', 'May', "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]}
                data={[0, 100, 200, 300, 400, 500, 400, 300, 300, 200, 250, 400]}
                tension={0.5}
                borderColor="#E81386"
                backgroundColor="#E81386"
              />
            </div>
            <MetricsData>
              <BoxData content="20" titre="ceci est le titre"/>
              <BoxData content="20" titre="ceci est le titre"/>
              <BoxData content="20" titre="ceci est le titre"/>
            </MetricsData>
          </ContentsContainer>
        </DataContainer>
        <br/>
        <br/>
        <DataContainer>
        
              <CurveChart
                labels={['Jan', 'Feb', 'Mar', 'Apr', 'May', "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]}
                data={[0, 100, 200, 300, 400, 500, 400, 300, 300, 200, 250, 400]}
                tension={0.5}
                borderColor="#E81386"
                backgroundColor="#E81386"
              />
              <DoubleBar
                labels={['Jan', 'Feb', 'Mar', 'Apr', 'May', "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]}
                data={[0, 100, 200, 300, 400, 500, 400, 300, 300, 200, 250, 400]}
                tension={0.5}
                borderColor="#E81386"
                backgroundColor="#E81386"
              /></DataContainer>
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
    grid-template-rows: 60% 40%;
`

export const MetricsData = styled.div`
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10rem;
    margin-top: 13rem;
`

export interface DashboardProps {
  title: string,
}

export default Dashboard