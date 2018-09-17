import Link from 'umi/link';
import styles from './index.css';

export default function() {
  return (
    <div className={styles.normal}>
      <div className={styles.welcome} />
      <ul className={styles.list}>
        <li><Link to="/catalog">Go to catalog page</Link></li>
      </ul>
    </div>
  );
}
