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
  return (
    <html lang="en">
      <body className={inter.className}>
        <header>
          <Image
            src="/logo.png"
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
