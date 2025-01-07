# PDO `fetch` 與 `fetchAll` 的差異

在 PHP 中使用 PDO 查詢資料庫時，`fetch(PDO::FETCH_ASSOC)` 和 `fetchAll(PDO::FETCH_ASSOC)` 的差別主要在於它們的用途和回傳的結果形式：

---

## **1. `fetch(PDO::FETCH_ASSOC)`**
- **功能**：從查詢結果集中獲取「單一筆記錄」。
- **回傳值**：會回傳一個**關聯陣列**，代表資料表中的一列數據。
- **使用場合**：當你只需要查詢結果中的第一筆資料時使用。
- **範例**：

```php
$sql = "SELECT * FROM users WHERE id = 1";
$stmt = $pdo->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($result);
```

- **輸出**（假設資料庫有以下結果）：
  ```php
  Array
  (
      [id] => 1
      [name] => John
      [email] => john@example.com
  )
  ```

---

## **2. `fetchAll(PDO::FETCH_ASSOC)`**
- **功能**：從查詢結果集中獲取「所有記錄」。
- **回傳值**：會回傳一個包含多筆資料的**關聯陣列**，每筆資料都是一個關聯陣列。
- **使用場合**：當你需要查詢結果中的「全部資料」時使用。
- **範例**：

```php
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($results);
```

- **輸出**（假設資料庫有以下結果）：
  ```php
  Array
  (
      [0] => Array
          (
              [id] => 1
              [name] => John
              [email] => john@example.com
          )
      [1] => Array
          (
              [id] => 2
              [name] => Jane
              [email] => jane@example.com
          )
  )
  ```

---

## **主要差異**

| 特性                     | `fetch()`                     | `fetchAll()`                 |
|--------------------------|-------------------------------|------------------------------|
| **回傳數量**              | 單筆資料                     | 全部資料                    |
| **回傳格式**              | 單個關聯陣列                | 多個關聯陣列組成的陣列     |
| **效能**                 | 適合取一筆資料，效能較高     | 資料量大時效能可能較差     |
| **用途**                 | 查詢特定記錄                | 查詢完整資料集             |

---

## **注意事項**

1. 如果查詢結果為空：
   - `fetch()` 回傳 `false`。
   - `fetchAll()` 回傳空陣列 `[]`。
2. 當資料量非常龐大時，建議使用 `fetch()` 來逐筆處理資料，避免一次載入大量資料導致記憶體消耗過高。

希望這能幫助你理解兩者的差異！
