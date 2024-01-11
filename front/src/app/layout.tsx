"use client"

import type { Metadata } from 'next'
import { Inter } from 'next/font/google'
import Image from 'next/image'
import './../styles/globals.css'

const inter = Inter({ subsets: ['latin'] })

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  let couleur = "rose";
  switch(window.location.pathname) {
    case("/delivery"):
      couleur = "bleu";
      break
    case("/client"):
      couleur = "vert";
      break
    case("/"):
      couleur = "orange";
      break
  }
  let img = "/" + couleur + ".png"
  return (
    <html lang="fr">
      <body className={inter.className}>
        <header className={couleur}>
          <Image
            src={img}
            alt="Vercel Logo"
            width={318}
            height={80}
          />
        </header>
        <div style={{ padding: "2rem" }}>
          {children}
        </div>
      </body>
    </html>
  )
}
