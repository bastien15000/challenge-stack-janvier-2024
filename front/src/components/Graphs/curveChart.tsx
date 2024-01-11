import React, { useEffect, useRef } from 'react';
import Chart from 'chart.js/auto';

const CurveChart: React.FC<ChartData> = (props) => {
    const chartRef = useRef();

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
    data: number[];
    borderColor?: string;
    backgroundColor?: string;
    tension: number;
}

export default CurveChart;