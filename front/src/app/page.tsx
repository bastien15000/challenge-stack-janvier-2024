import styles from './page.module.css'
import Graph from './graph'

export default function Home() {
  return (
    <main className={styles.main}>
      <Graph />
    </main>
  )
}
