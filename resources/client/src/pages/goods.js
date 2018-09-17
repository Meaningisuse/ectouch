import Link from 'umi/link';
import styles from './index.css';

export default function() {
  return (
    <div className={styles.normal}>
      <div className={styles.welcome} />
      <ul className={styles.list}>
        <li><a href="https://umijs.org/guide/getting-started.html">Getting Started</a></li>
      </ul>
    </div>
  );
}
