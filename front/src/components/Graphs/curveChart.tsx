import React, { useEffect, useRef, useState } from 'react';
import Chart from 'chart.js/auto';
import { Api } from "@/services/api"

const CurveChart: React.FC<ChartData> = (props) => {
    const chartRef = useRef();
    const [info, setInfos] = useState([]) // Initialisation de l'état

    useEffect(() => {
        Api.ajax("kpi/serviceRate", "GET")
      .then(data => {
        setInfos(data.perDays) // Mise à jour de l'état avec les nouvelles données
        const config = {
            type: 'line',
            data: {
                labels: props.labels,
                datasets: [{
                    label: '',
                    data: info,
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
      })
    }, [])

    return (
      <canvas ref={chartRef} id="myChart"></canvas>
    )
}

export interface ChartData {
    labels: string[];
    data: number[];
    borderColor?: string;
    backgroundColor?: string;
    tension: number;
}

export default CurveChart;