'use client';
import { CurveChart } from "./graphs/curve"
import { BarChart } from "./graphs/bar"

export default function Graph() {
    return (
        <main>
            <CurveChart />
            <BarChart />
        </main>
    )
}