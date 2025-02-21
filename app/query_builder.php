<?php
class QueryBuilder
{
  private $pdo;
  private $table;
  private $query;
  private $bindings = [];

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function table($table)
  {
    $this->table = $table;
    return $this;
  }

  public function select($columns = '*')
  {
    $this->query = "SELECT $columns FROM {$this->table}";
    return $this;
  }

  public function where($column, $operator, $value)
  {
    $this->query .= " WHERE $column $operator ?";
    $this->bindings[] = $value;
    return $this;
  }

  public function limit($limit)
  {
    $this->query .= " LIMIT ?";
    $this->bindings[] = $limit;
    return $this;
  }

  public function get()
  {
    $stmt = $this->pdo->prepare($this->query);
    $stmt->execute($this->bindings);
    return $stmt->fetchAll();
  }

  public function insert($data)
  {
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $this->query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
    $stmt = $this->pdo->prepare($this->query);
    return $stmt->execute(array_values($data));
  }

  public function update($data, $id)
  {
    $setClause = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));
    $this->query = "UPDATE {$this->table} SET $setClause WHERE id = ?";
    $stmt = $this->pdo->prepare($this->query);
    return $stmt->execute([...array_values($data), $id]);
  }

  public function delete($id)
  {
    $this->query = "DELETE FROM {$this->table} WHERE id = ?";
    $stmt = $this->pdo->prepare($this->query);
    return $stmt->execute([$id]);
  }

  public function raw($query, $bindings = [])
  {
    $this->query = $query;
    $this->bindings = $bindings;
    return $this;
  }
}
