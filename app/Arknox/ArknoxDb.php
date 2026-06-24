<?php

namespace App\Arknox;

class ArknoxBuilder
{
    private ArknoxDb $db;
    private string   $table;
    private array    $selects   = [];
    private array    $joins     = [];
    private array    $wheres    = [];
    private array    $order_bys = [];
    private array    $group_bys = [];
    private ?int     $lim       = null;
    private ?int     $off       = null;
    private array    $params    = [];

    public function __construct(ArknoxDb $db, string $table)
    {
        $this->db    = $db;
        $this->table = $table;
    }

    public function select($columns = ['*']): static
    {
        $cols = is_array($columns) ? $columns : func_get_args();
        foreach ($cols as $c) $this->selects[] = $c;
        return $this;
    }

    public function addSelect($columns): static { return $this->select($columns); }

    public function join(string $table, string $first, string $op = '=', string $second = '', string $type = 'INNER'): static
    {
        $this->joins[] = strtoupper($type) . " JOIN `$table` ON $first $op $second";
        return $this;
    }

    public function leftJoin(string $table, string $first, string $op = '=', string $second = ''): static
    {
        return $this->join($table, $first, $op, $second, 'LEFT');
    }

    public function where($column, $operator = null, $value = null): static
    {
        return $this->_addWhere($column, $operator, $value, 'AND');
    }

    public function orWhere($column, $operator = null, $value = null): static
    {
        return $this->_addWhere($column, $operator, $value, 'OR');
    }

    public function whereIn(string $column, array $values): static
    {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $this->wheres[] = ['sql' => "`$column` IN ($placeholders)", 'op' => 'AND'];
        foreach ($values as $v) $this->params[] = $v;
        return $this;
    }

    public function whereNotIn(string $column, array $values): static
    {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $this->wheres[] = ['sql' => "`$column` NOT IN ($placeholders)", 'op' => 'AND'];
        foreach ($values as $v) $this->params[] = $v;
        return $this;
    }

    public function whereNull(string $column): static
    {
        $this->wheres[] = ['sql' => "`$column` IS NULL", 'op' => 'AND'];
        return $this;
    }

    public function whereNotNull(string $column): static
    {
        $this->wheres[] = ['sql' => "`$column` IS NOT NULL", 'op' => 'AND'];
        return $this;
    }

    public function whereBetween(string $column, array $range): static
    {
        $this->wheres[] = ['sql' => "`$column` BETWEEN ? AND ?", 'op' => 'AND'];
        $this->params[] = $range[0];
        $this->params[] = $range[1];
        return $this;
    }

    public function whereLike(string $column, string $value): static
    {
        $this->wheres[] = ['sql' => "`$column` LIKE ?", 'op' => 'AND'];
        $this->params[] = $value;
        return $this;
    }

    public function orderBy(string $column, string $direction = 'asc'): static
    {
        $this->order_bys[] = "`$column` " . strtoupper($direction);
        return $this;
    }

    public function orderByDesc(string $column): static { return $this->orderBy($column, 'desc'); }

    public function groupBy(string ...$columns): static
    {
        foreach ($columns as $c) $this->group_bys[] = "`$c`";
        return $this;
    }

    public function limit(int $value): static  { $this->lim = $value; return $this; }
    public function offset(int $value): static { $this->off = $value; return $this; }
    public function take(int $value): static   { return $this->limit($value); }
    public function skip(int $value): static   { return $this->offset($value); }

    public function get(): \Illuminate\Support\Collection
    {
        return collect($this->db->select($this->_buildSelect(), $this->params));
    }

    public function first(): ?object
    {
        $this->lim = 1;
        $result = $this->db->select($this->_buildSelect(), $this->params);
        return $result[0] ?? null;
    }

    public function find($id, string $keyColumn = 'id'): ?object
    {
        return $this->where($keyColumn, $id)->first();
    }

    public function value(string $column): mixed
    {
        $row = $this->first();
        return $row ? ($row->$column ?? null) : null;
    }

    public function pluck(string $column): \Illuminate\Support\Collection
    {
        return $this->get()->pluck($column);
    }

    public function count(): int
    {
        $wsql = $this->_buildWhere();
        $jsql = $this->joins ? ' ' . implode(' ', $this->joins) : '';
        $sql  = "SELECT COUNT(*) AS aggregate FROM `{$this->table}`$jsql" . ($wsql ? " WHERE $wsql" : '');
        $rows = $this->db->select($sql, $this->params);
        return (int) ($rows[0]->aggregate ?? 0);
    }

    public function exists(): bool      { return $this->count() > 0; }
    public function doesntExist(): bool { return !$this->exists(); }

    public function max(string $column): mixed { return $this->_aggregate('MAX', $column); }
    public function min(string $column): mixed { return $this->_aggregate('MIN', $column); }
    public function sum(string $column): mixed { return $this->_aggregate('SUM', $column); }
    public function avg(string $column): mixed { return $this->_aggregate('AVG', $column); }

    public function insert(array $data): bool
    {
        if (empty($data)) return false;
        $isMulti = isset($data[0]) && is_array($data[0]);
        $rows    = $isMulti ? $data : [$data];
        $cols    = array_keys($rows[0]);
        $colSql  = implode(', ', array_map(fn($c) => "`$c`", $cols));
        $rowPh   = '(' . implode(', ', array_fill(0, count($cols), '?')) . ')';
        $allPh   = implode(', ', array_fill(0, count($rows), $rowPh));
        $params  = [];
        foreach ($rows as $row) foreach ($cols as $c) $params[] = $row[$c];
        return $this->db->statement("INSERT INTO `{$this->table}` ($colSql) VALUES $allPh", $params);
    }

    public function insertGetId(array $data): int
    {
        $this->insert($data);
        return $this->db->lastInsertId();
    }

    public function update(array $data): int
    {
        $sets   = implode(', ', array_map(fn($c) => "`$c` = ?", array_keys($data)));
        $wsql   = $this->_buildWhere();
        $params = array_merge(array_values($data), $this->params);
        $sql    = "UPDATE `{$this->table}` SET $sets" . ($wsql ? " WHERE $wsql" : '');
        return $this->db->affectingStatement($sql, $params);
    }

    public function updateOrInsert(array $attributes, array $values = []): bool
    {
        foreach ($attributes as $k => $v) $this->where($k, $v);
        if ($this->exists()) return $this->update($values) !== false;
        return $this->insert(array_merge($attributes, $values));
    }

    public function delete(): int
    {
        $wsql = $this->_buildWhere();
        $sql  = "DELETE FROM `{$this->table}`" . ($wsql ? " WHERE $wsql" : '');
        return $this->db->affectingStatement($sql, $this->params);
    }

    public function truncate(): bool
    {
        return $this->db->statement("TRUNCATE TABLE `{$this->table}`");
    }

    public function increment(string $column, int $amount = 1, array $extra = []): int
    {
        $sets   = ["`$column` = `$column` + $amount"];
        $params = [];
        foreach ($extra as $k => $v) { $sets[] = "`$k` = ?"; $params[] = $v; }
        $wsql = $this->_buildWhere();
        return $this->db->affectingStatement(
            "UPDATE `{$this->table}` SET " . implode(', ', $sets) . ($wsql ? " WHERE $wsql" : ''),
            array_merge($params, $this->params)
        );
    }

    public function decrement(string $column, int $amount = 1, array $extra = []): int
    {
        return $this->increment($column, -$amount, $extra);
    }

    private function _aggregate(string $fn, string $column): mixed
    {
        $wsql = $this->_buildWhere();
        $jsql = $this->joins ? ' ' . implode(' ', $this->joins) : '';
        $sql  = "SELECT $fn(`$column`) AS aggregate FROM `{$this->table}`$jsql" . ($wsql ? " WHERE $wsql" : '');
        $rows = $this->db->select($sql, $this->params);
        return $rows[0]->aggregate ?? null;
    }

    private function _buildSelect(): string
    {
        $sel   = $this->selects ? implode(', ', $this->selects) : '*';
        $joins = $this->joins ? ' ' . implode(' ', $this->joins) : '';
        $where = $this->_buildWhere();
        $group = $this->group_bys ? ' GROUP BY ' . implode(', ', $this->group_bys) : '';
        $order = $this->order_bys ? ' ORDER BY ' . implode(', ', $this->order_bys) : '';
        $lim   = $this->lim !== null ? ' LIMIT ' . $this->lim : '';
        $off   = $this->off !== null ? ' OFFSET ' . $this->off : '';
        return "SELECT $sel FROM `{$this->table}`$joins" . ($where ? " WHERE $where" : '') . $group . $order . $lim . $off;
    }

    private function _buildWhere(): string
    {
        if (!$this->wheres) return '';
        $parts = [];
        foreach ($this->wheres as $w) {
            $glue    = ($parts && end($parts) !== '(') ? " {$w['op']} " : '';
            $parts[] = $glue . $w['sql'];
        }
        return implode('', $parts);
    }

    private function _addWhere($column, $operator, $value, string $logic): static
    {
        if (is_array($column)) {
            foreach ($column as $k => $v) $this->_addWhere($k, '=', $v, $logic);
            return $this;
        }
        // ->where('col', 'val') two-arg shorthand
        if ($value === null && $operator !== null) { $value = $operator; $operator = '='; }

        if ($value === null) {
            $this->wheres[] = ['sql' => "`$column` IS NULL", 'op' => $logic];
        } else {
            $this->wheres[] = ['sql' => "`$column` $operator ?", 'op' => $logic];
            $this->params[] = $value;
        }
        return $this;
    }
}


class ArknoxDb
{
    private string $api_url;
    private string $masked_db;
    private string $masked_user;
    private string $masked_password;
    private int    $last_insert_id     = 0;
    private int    $last_affected_rows = 0;

    public function __construct(string $apiUrl, string $database, string $username, string $password)
    {
        $this->api_url         = rtrim($apiUrl, '/');
        $this->masked_db       = $database;
        $this->masked_user     = $username;
        $this->masked_password = $password;
    }

    public function table(string $table): ArknoxBuilder
    {
        return new ArknoxBuilder($this, $table);
    }

    /** Raw SELECT — returns array of stdClass (like DB::select). */
    public function select(string $sql, array $bindings = []): array
    {
        $data = $this->_call($sql, $bindings);
        if (!($data['success'] ?? false)) {
            $this->_logError($sql, $data['error'] ?? 'unknown');
            return [];
        }
        return array_map(fn($r) => (object) $r, $data['rows'] ?? []);
    }

    /** Raw statement — returns bool (like DB::statement). */
    public function statement(string $sql, array $bindings = []): bool
    {
        $data = $this->_call($sql, $bindings);
        if (!($data['success'] ?? false)) {
            $this->_logError($sql, $data['error'] ?? 'unknown');
            return false;
        }
        $this->last_insert_id     = (int) ($data['insert_id'] ?? 0);
        $this->last_affected_rows = (int) ($data['affected_rows'] ?? 0);
        return true;
    }

    /** Raw write — returns affected row count (like DB::update / DB::delete). */
    public function affectingStatement(string $sql, array $bindings = []): int
    {
        $this->statement($sql, $bindings);
        return $this->last_affected_rows;
    }

    public function lastInsertId(): int { return $this->last_insert_id; }

    private function _call(string $sql, array $params): array
    {
        $ch = curl_init($this->api_url . '/api/query');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode([
                'sql'            => $sql,
                'params'         => $params,
                'maskedDbName'   => $this->masked_db,
                'maskedUser'     => $this->masked_user,
                'maskedPassword' => $this->masked_password,
            ]),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json', 'Accept: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        $res = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) return ['success' => false, 'error' => "cURL: $err"];
        $decoded = json_decode($res, true);
        return is_array($decoded) ? $decoded : ['success' => false, 'error' => 'Invalid JSON response'];
    }

    private function _logError(string $sql, string $message): void
    {
        if (function_exists('logger')) {
            logger()->error('ArknoxDb: ' . $message, ['sql' => $sql]);
        } else {
            error_log("ArknoxDb error: $message | SQL: $sql");
        }
    }
}
