import React, { useEffect, useState } from "react"
import { Api } from "@/services/api"

export const BoxData: React.FC<BoxData> = (props) => {
  const [infoBox, setInfoBox] = useState([]) // Initialisation de l'état
  const [infoBox2, setInfoBox2] = useState([]) // Initialisation de l'état
  const [infoBox3, setInfoBox3] = useState([]) // Initialisation de l'état
  var stat;
  useEffect(() => {
    
    Api.ajax("kpi/serviceRate", "GET")
      .then(data => {
        setInfoBox(data.ordersTotal)
        setInfoBox2(data.ordersDelivered)
        setInfoBox3(data.rate)
        if (props.titre == "Total des commandes") {
          stat = infoBox;
        }
        else if(props.titre == "Total des commandes livrée") {
          stat = infoBox2;
        }
        else if(props.titre == "Pourcentage livrée par jours") {
          stat = infoBox3;
        }
      })
  }, [])

  

  return (
    <div className="data">
      <p className="stat-title">{props.titre}</p>
      <p className="data-content">{props.content}</p>
    </div>
  )
}

export interface BoxData {
  titre: string,
  content: string,
  id?: string,
}
