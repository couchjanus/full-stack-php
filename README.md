# full-stack-php


```php
<?php

$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create TABLE categories
$sql = "CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    status tinyint(1) NOT NULL,
    PRIMARY KEY (id)
);";

/* проверка соединения */
try {
    $connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    echo "Connected successfully\n";
    $connection->query($sql);
    echo "Table Created successfully\n";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "\n";
    die();
} finally {
    // код, который будет выполнен при любом раскладе
    $connection = null;
}
?>
```

```php

<?php

$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create TABLE products
$sql = "CREATE TABLE products (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    status tinyint(1) NOT NULL,
    category_id int(11) UNSIGNED DEFAULT NULL,
    price float UNSIGNED NOT NULL,
    brand varchar(255) NOT NULL,
    description text NOT NULL,
    is_new tinyint(1) NOT NULL DEFAULT '1',
    is_recommended tinyint(1) NOT NULL DEFAULT '0'
    PRIMARY KEY (id)
);";


/* проверка соединения */
try {
    $connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    echo "Connected successfully\n";
    $connection->query($sql);
    echo "Table Created successfully\n";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "\n";
    die();
} finally {
    // код, который будет выполнен при любом раскладе
    $connection = null;
}
?>
```

```php

return [
    'database' => [
        'name' => 'mydb',
        'username' => 'dev',
        'password' => 'ghbdtn',
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
```

```php

 <?php

 class Connection
 {
  public static function make()
  {
    $db = include CONFIG.'db.php';

    $config = $db['database'];

    try {
      return new PDO(
        $config['connection'].';dbname='.$config['name'],
        $config['username'],
        $config['password'],
        $config['options']
      );

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
 }

```

```php
<?php

class View {

    public function render($path, $data = [], $error = false){
        extract($data);
        return require VIEWS."/{$path}.php";
    }

}

```

```php
<?php

class Controller {

    protected $_view;
    
    function __construct()
    {
        $this->_view = new View();
    }

    // действие (action), вызываемое по умолчанию
    function actionIndex()
    {
        // todo
    }
}


```
```php
<?php

class AboutController extends Controller
{
    public function index()
    {
        $title = 'SHOPAHOLIC <b>ABOUT PAGE</b>';
        
        $this->_view->render('home/about', ['title'=>$title]);
    }
    
}


```

```php

<?php

class HomeController extends Controller
{
    
    public function index()
    {   
        $title = 'Our <b>Cat Members</b>';

        $this->_view->render('home/index', ['title'=>$title]);

    }
    
}

```

```php

<?php

if (function_exists('date_default_timezone_set')){
    date_default_timezone_set('Europe/Kiev');    
}


// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);


require_once realpath(__DIR__).'/../config/app.php';

require_once CORE.'Connection.php';
require_once CORE.'View.php';
require_once CORE.'Controller.php';
require_once CORE.'Router.php';
```
