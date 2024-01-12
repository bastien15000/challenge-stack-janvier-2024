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
            <Typography variant="h5">Ceci est le titre du premier graph</Typography>
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
            <MetricsData style={{ marginTop: "0px",}}>
              <BoxData content="20" titre="ceci est le titre"/>
              <BoxData content="20" titre="ceci est le titre"/>
              <BoxData content="20" titre="ceci est le titre"/>
            </MetricsData>
          </ContentsContainer>
        </DataContainer>

        <br/>
        <br/>


        <DataContainer>
          <div style={{
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
          }}>
            <Typography variant="h5">Ceci est le titre du deuxieme graph</Typography>
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
            <MetricsData style={{ marginTop: "0px",}}>
              <BoxData content="20" titre="ceci est le titre"/>
              <BoxData content="20" titre="ceci est le titre"/>
            </MetricsData>
          </ContentsContainer>
        </DataContainer>
        <br/>
        <br/>

        <DataContainer>
          <div style={{
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
          }}>
            <Typography variant="h5">Ceci est le titre du troisieme graph</Typography>
          </div>
          <br/>
          <Divider light/>
          <br/>
          <ContentsContainer>
            <div>
              <DoubleBar
                labels={['Jan', 'Feb', 'Mar', 'Apr', 'May', "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]}
                data={[0, 100, 200, 300, 400, 500, 400, 300, 300, 200, 250, 400]}
                tension={0.5}
                borderColor="#E81386"
                backgroundColor="#E81386"
              />
            </div>
            <MetricsData style={{ marginTop: "0px",}}>
              <BoxData content="20" titre="ceci est le titre"/>
              <BoxData content="20" titre="ceci est le titre"/>
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