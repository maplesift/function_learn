# PHP `save` 函式的 SQL 拼接示範

## 功能簡介

`save` 函式是用於將資料插入或更新到資料庫的一個通用方法，根據傳入的陣列是否包含 `id`，決定執行 `INSERT` 或 `UPDATE` 操作。

此外，輔助函式 `a2s` 的作用是將陣列的鍵值對轉換為適合 SQL 語句的格式，主要用於更新資料時的 `SET` 部分。

---

## 程式碼

```php
function save($array){

    if(isset($array['id'])){
        // update
        $id = $array['id'];
        unset($array['id']);
        $set = $this->a2s($array);
        $sql = "UPDATE $this->table SET ".join(',', $set)." WHERE `id`='$id'";
    } else {
        // insert
        $cols = array_keys($array);
        $sql = "INSERT INTO $this->table (`".join("`,`", $cols)."`) VALUES('".join("','", $array)."')";
    }

    // echo $sql;
    return $this->pdo->exec($sql);
}

function a2s($array){
    $tmp = [];
    foreach($array as $key => $val){
        $tmp[] = "`$key`='$val'";
    }
    return $tmp;
}
```

---

## 使用範例

以下是一些範例，展示 SQL 語句的拼接過程：

### 1. 更新資料 (`UPDATE`) 範例

傳入參數：
```php
$array = [
    'id' => 5,
    'name' => 'John',
    'age' => 30,
    'city' => 'New York'
];
$this->table = 'users';
```

執行過程：
1. `id` 被取出，剩下的資料為：
   ```php
   [
       'name' => 'John',
       'age' => 30,
       'city' => 'New York'
   ];
   ```
2. `a2s` 方法處理 `$array`，生成：
   ```php
   [
       "`name`='John'",
       "`age`='30'",
       "`city`='New York'"
   ];
   ```
3. 拼接成 SQL 語句：
   ```sql
   UPDATE users SET `name`='John',`age`='30',`city`='New York' WHERE `id`='5'
   ```

---

### 2. 新增資料 (`INSERT`) 範例

傳入參數：
```php
$array = [
    'name' => 'Alice',
    'age' => 25,
    'city' => 'Los Angeles'
];
$this->table = 'users';
```

執行過程：
1. 取出 `$array` 的鍵值（`keys` 和 `values`）：
   ```php
   $cols = ['name', 'age', 'city'];
   $values = ['Alice', 25, 'Los Angeles'];
   ```
2. 拼接成 SQL 語句：
   ```sql
   INSERT INTO users (`name`,`age`,`city`) VALUES('Alice','25','Los Angeles')
   ```

---

### 3. 輔助函式 `a2s` 機制

`a2s` 函式用於將陣列的鍵值對轉換成 `key='value'` 的格式。例如：

傳入參數：
```php
$array = [
    'name' => 'Charlie',
    'email' => 'charlie@example.com'
];
$result = $this->a2s($array);
```

輸出：
```php
[
    "`name`='Charlie'",
    "`email`='charlie@example.com'"
]
```

---

## 總結

`save` 函式根據不同場景生成以下 SQL：

1. 包含 `id` 時，生成 `UPDATE` 語句：
   ```sql
   UPDATE <table> SET <key1>='<value1>',<key2>='<value2>' WHERE `id`='<id>'
   ```

2. 不包含 `id` 時，生成 `INSERT` 語句：
   ```sql
   INSERT INTO <table> (`<key1>`,`<key2>`) VALUES('<value1>','<value2>')
   ```

---

如有任何疑問或需要進一步說明，請隨時聯絡！
