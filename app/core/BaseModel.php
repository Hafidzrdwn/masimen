<?php

namespace App\Core;

class ModelNotFoundException extends \Exception {}

abstract class BaseModel
{
  protected static ?QueryBuilder $qb = null;
  protected string $table;
  protected string $primaryKey = 'id';
  protected array $attributes = [];

  /**
   * Constructor untuk mengisi data model (hydrating).
   */
  public function __construct(array $attributes = [])
  {
    $this->fill($attributes);
    $this->boot();
  }

  /**
   * Inisialisasi dasar untuk model.
   */
  protected function boot(): void
  {
    if (is_null(self::$qb)) {
      self::$qb = new QueryBuilder();
    }

    if (empty($this->table)) {
      $this->setTableFromClassName();
    }
  }

  private function setTableFromClassName(): void
  {
    $className = basename(str_replace('\\', '/', get_called_class()));
    $this->table = strtolower($className) . 's';
  }

  /**
   * Memungkinkan pemanggilan method QueryBuilder secara statis.
   * Contoh: User::where('id', 1)->get();
   */
  public static function __callStatic(string $method, array $args)
  {
    return (new static())->$method(...$args);
  }

  /**
   * Memungkinkan pemanggilan method QueryBuilder dari instance.
   * Contoh: $user->where('id', 1)->get();
   */
  public function __call(string $method, array $args)
  {
    self::$qb->table($this->table);
    $result = self::$qb->$method(...$args);

    if ($result instanceof QueryBuilder) {
      return $this;
    }

    return $result;
  }

  // --- Laravel-like Methods ---

  /**
   * Mengambil semua record dari tabel.
   * Penggunaan: User::all();
   */
  public static function all(): array
  {
    $instance = new static();
    $results = self::$qb->table($instance->table)->select()->get();
    return array_map(fn($item) => new static($item), $results);
  }

  /**
   * Mencari record berdasarkan primary key.
   * Penggunaan: User::find(1);
   */
  public static function find(int|string $id): ?static
  {
    $instance = new static();
    $data = self::$qb->table($instance->table)
      ->select()
      ->where($instance->primaryKey, '=', $id)
      ->get();

    return $data ? new static($data[0]) : null;
  }

  /**
   * Seperti find(), tapi melempar exception jika tidak ditemukan.
   * Penggunaan: User::findOrFail(1);
   */
  public static function findOrFail(int|string $id): static
  {
    $model = static::find($id);
    if (!$model) {
      throw new ModelNotFoundException('No record found for ID ' . $id);
    }
    return $model;
  }

  /**
   * Membuat record baru di database.
   * Penggunaan: User::create(['name' => 'John', 'email' => 'john@doe.com']);
   */
  public static function create(array $data): static
  {
    $instance = new static();
    self::$qb->table($instance->table)->insert($data);
    $lastId = self::$qb->lastInsertId();
    return static::find($lastId);
  }

  /**
   * Menyimpan perubahan (update) ke database.
   * Penggunaan: $user->update(['name' => 'Jane']);
   */
  public function update(array $data): bool
  {
    $id = $this->{$this->primaryKey};
    return self::$qb->table($this->table)->update($data, $id);
  }

  /**
   * Menghapus record dari database.
   * Penggunaan: $user->delete();
   */
  public function delete(): bool
  {
    $id = $this->{$this->primaryKey};
    return self::$qb->table($this->table)->delete($id);
  }

  // --- Helper & Magic Methods ---

  public function fill(array $attributes): void
  {
    $this->attributes = $attributes;
  }

  public function __get(string $key)
  {
    return $this->attributes[$key] ?? null;
  }

  public function __set(string $key, $value): void
  {
    $this->attributes[$key] = $value;
  }
}
