<?php

namespace App\Libraries;

use App\Kernel\Model;

/**
 * MYSQL 公用类库
 * Class Mysql
 * @package App\Libraries
 */
class Mysql extends Model
{
    /**
     * @param string $sql
     * @return false|int|mixed
     */
    public function query($sql)
    {
        $m = strtolower(substr(ltrim(trim($sql), '('), 0, 4));
        if (in_array($m, ['sele', 'desc', 'show'])) {
            $res = parent::query($sql);
        } else {
            $res = parent::execute($sql);
        }

        return $res;
    }

    /**
     * @return mixed
     */
    public function error()
    {
        return $this->getError();
    }

    /**
     * @return mixed
     */
    public function errno()
    {
        return $this->getError();
    }

    /**
     * @return bool|mixed
     */
    public function version()
    {
        return $this->getOne('SELECT version()');
    }

    /**
     * @return bool|mixed
     */
    public function insert_id()
    {
        return $this->getOne('SELECT LAST_INSERT_ID()');
    }

    /**
     * @param $sql
     * @param $num
     * @param int $start
     * @return false|int|mixed
     */
    public function selectLimit($sql, $num, $start = 0)
    {
        if ($start == 0) {
            $sql .= ' LIMIT ' . $num;
        } else {
            $sql .= ' LIMIT ' . $start . ', ' . $num;
        }

        return $this->query($sql);
    }

    /**
     * @param $sql
     * @param bool $limited
     * @return bool|mixed
     */
    public function getOne($sql, $limited = false)
    {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if (!empty($res)) {
            return current($res[0]);
        } else {
            return false;
        }
    }

    /**
     * @param $sql
     * @return bool|mixed
     */
    public function getOneCached($sql)
    {
        $sql = trim($sql . ' LIMIT 1');
        $cache_id = md5($sql);

        $result = cache($cache_id);

        if (is_null($result)) {
            $result = $this->getOne($sql, true);
            cache([$cache_id, $result]);
        }

        return $result;
    }

    /**
     * @param $sql
     * @return false|int|mixed
     */
    public function getAll($sql)
    {
        return $this->query($sql);
    }

    /**
     * @param $sql
     * @return false|int|mixed
     */
    public function getAllCached($sql)
    {
        $cache_id = md5($sql);

        $result = cache($cache_id);

        if (is_null($result)) {
            $result = $this->getAll($sql);
            cache([$cache_id, $result]);
        }

        return $result;
    }

    /**
     * @param $sql
     * @param bool $limited
     * @return array|mixed
     */
    public function getRow($sql, $limited = false)
    {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if (!empty($res)) {
            return current($res);
        } else {
            return [];
        }
    }

    /**
     * @param $sql
     * @return array|mixed
     */
    public function getRowCached($sql)
    {
        $sql = trim($sql . ' LIMIT 1');

        $cache_id = md5($sql);

        $result = cache($cache_id);

        if (is_null($result)) {
            $result = $this->getRow($sql, true);
            cache([$cache_id, $result]);
        }

        return $result;
    }

    /**
     * @param $sql
     * @return array
     */
    public function getCol($sql)
    {
        $res = $this->query($sql);
        if (!empty($res)) {
            $arr = [];
            foreach ($res as $row) {
                $arr[] = current($row);
            }

            return $arr;
        } else {
            return [];
        }
    }

    /**
     * @param $sql
     * @return array|mixed
     */
    public function getColCached($sql)
    {
        $cache_id = md5($sql);

        $result = cache($cache_id);

        if (is_null($result)) {
            $result = $this->getCol($sql);
            cache($cache_id, $result);
        }

        return $result;
    }

    /**
     * @param $table
     * @param $field_values
     * @param string $mode
     * @param string $where
     * @return bool|false|int|mixed
     */
    public function autoExecute($table, $field_values, $mode = 'INSERT', $where = '')
    {
        $field_names = $this->getCol('DESC ' . $table);

        $sql = '';
        if ($mode == 'INSERT') {
            $fields = $values = [];
            foreach ($field_names as $value) {
                if (array_key_exists($value, $field_values) == true) {
                    $fields[] = $value;
                    $values[] = "'" . $field_values[$value] . "'";
                }
            }

            if (!empty($fields)) {
                $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
            }
        } else {
            $sets = [];
            foreach ($field_names as $value) {
                if (array_key_exists($value, $field_values) == true) {
                    $sets[] = $value . " = '" . $field_values[$value] . "'";
                }
            }

            if (!empty($sets)) {
                $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
            }
        }

        if ($sql) {
            return $this->query($sql);
        } else {
            return false;
        }
    }

    /**
     * @param $table
     * @param $field_values
     * @param $update_values
     * @return bool|false|int|mixed
     */
    public function autoReplace($table, $field_values, $update_values)
    {
        $field_descs = $this->getAll('DESC ' . $table);

        $primary_keys = [];
        foreach ($field_descs as $value) {
            $field_names[] = $value['Field'];
            if ($value['Key'] == 'PRI') {
                $primary_keys[] = $value['Field'];
            }
        }

        $fields = $values = [];
        foreach ($field_names as $value) {
            if (array_key_exists($value, $field_values) == true) {
                $fields[] = $value;
                $values[] = "'" . $field_values[$value] . "'";
            }
        }

        $sets = [];
        foreach ($update_values as $key => $value) {
            if (array_key_exists($key, $field_values) == true) {
                if (is_int($value) || is_float($value)) {
                    $sets[] = $key . ' = ' . $key . ' + ' . $value;
                } else {
                    $sets[] = $key . " = '" . $value . "'";
                }
            }
        }

        $sql = '';
        if (empty($primary_keys)) {
            if (!empty($fields)) {
                $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
            }
        } else {
            if (!empty($fields)) {
                $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
                if (!empty($sets)) {
                    $sql .= 'ON DUPLICATE KEY UPDATE ' . implode(', ', $sets);
                }
            }
        }

        if ($sql) {
            return $this->query($sql);
        } else {
            return false;
        }
    }
}
