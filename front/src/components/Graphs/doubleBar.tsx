import Chart from 'chart.js/auto';
import { useEffect, useRef } from 'react';

const DoubleBar: React.FC<DoubleBar> = (props) => {
  const chartRef = useRef();

  useEffect(() => {
    const data = {
      labels: props.labels,
      datasets: [{
        type: 'bar',
        label: 'Consommation réelle',
        data: props.data,
        borderColor: props.borderColor,
        backgroundColor: props.backgroundColor
      }, {
        type: 'bar',
        label: 'Consommation théorique',
        data: [17, 28, 13, 22],
        fill: false,
        borderColor: 'rgb(54, 162, 235)'
      }]
    };
    const config = {
      type: 'scatter',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true
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
export interface DoubleBar {
  labels: string[];
  data: number[];
  borderColor?: string;
  backgroundColor?: string;
  tension?: number;
}
export default DoubleBar;