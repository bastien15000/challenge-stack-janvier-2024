import Chart from 'chart.js/auto';
import { useEffect, useRef } from 'react';

export const CurveChart = () => {
    const chartRef = useRef();

    useEffect(() => {
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const data = {
            labels: labels,
            datasets: [{
                label: '',
                data: [0, 100, 200, 300, 400, 500, 400, 300, 300, 200, 250, 400],
                borderColor: '#E81386',
                backgroundColor: '#E81386',
                tension: 0.5
            }],
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                layout: {
                    padding: 50
                },
                plugins: {
                    legend: {
                        display: false // Supprimez la légende ici
                    }
                },
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