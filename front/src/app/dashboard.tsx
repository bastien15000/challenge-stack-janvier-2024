'use client';
import { CurveChart } from "../components/Graphs/curve"
import { BarChart } from "../components/Graphs/bar"
import "./../styles/dashboard.css"

export default function Dashboard() {
    return (
        <main className="graphs-container">
            <div className="main-graph">
                <CurveChart />
                <div className="datas">
                    <div className="data">
                        <p className="stat-title">Stat 1</p>
                        <p className="data-content">20</p>
                    </div>
                    <div className="data">
                        <p className="stat-title">Stat 2</p>
                        <p className="data-content">20</p>
                    </div>
                    <div className="data">
                        <p className="stat-title">Stat 3</p>
                        <p className="data-content">20</p>
                    </div>
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