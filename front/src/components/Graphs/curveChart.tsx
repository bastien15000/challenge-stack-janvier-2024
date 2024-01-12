import React, { useEffect, useRef, useState } from 'react';
import Chart from 'chart.js/auto';
import { Api } from "@/services/api"

const CurveChart: React.FC<ChartData> = (props) => {
    const chartRef = useRef();

    useEffect(() => {
        const config = {
            type: 'line',
            data: {
                labels: props.labels,
                datasets: [{
                    label: '',
                    data: props.data,
                    borderColor: props.borderColor,
                    backgroundColor: props.backgroundColor,
                    tension: props.tension
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };

        var myChart = new Chart(
            chartRef.current,
            config
        );
        return () => {
            if (myChart) {
                myChart.destroy();
            }
        };
    }, [])

    return (
        <canvas ref={chartRef} id="myChart"></canvas>
    )
}

export interface ChartData {
    labels: string[];
    data: Float32Array[];
    borderColor?: string;
    backgroundColor?: string;
    tension: number;
}

export default CurveChart;