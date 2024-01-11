'use client';
import { CurveChart } from "../components/Graphs/curve"
import { BarChart } from "../components/Graphs/bar"
import { BoxData } from "../components/Graphs/boxData"
import "./../styles/dashboard.css"

export default function Dashboard() {
    return (
        <main className="graphs-container">
            <div className="main-graph">
                <CurveChart />
                <div className="datas">
                    <BoxData titre="Stat1" content="40"/>
                    <BoxData titre="Stat2" content="30"/>
                    <BoxData titre="Stat3" content="18"/>
                </div>
            </div>
            <div className="secondary-graphs" style={{ display: 'flex' }}>
                <div className="secondary-graph">
                    <CurveChart />
                </div>
                <div className="secondary-graph">
                    <CurveChart />
                </div>
                <div className="secondary-graph">
                    <CurveChart />
                </div>
            </div>
        </main>
    )
}