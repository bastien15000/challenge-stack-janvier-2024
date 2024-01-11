import React from "react";

export const BoxData: React.FC<BoxData> = (props) => {
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
