# sdk
针对http://manage.mark-here.com/ API编写的简单SDK实现

# 使用方法
```php
require_once 'autoload.php';  

use SDK\Client;  

$client = new Client('http://manage.mark-here.com/api/', 'admin@admin.com', '123456');
$result = $client->listAlbums();  
print_r($result);  

$result = $client->infoAlbum('1');
print_r($result);  

$result = $client->listPictures();
print_r($result);  

$result = $client->infoPicture('2');
print_r($result);  

$result = $client->listFolders();
print_r($result);  

$result = $client->infoFolder('2');
print_r($result);  

$result = $client->listFiles();
print_r($result);  

$result = $client->infoFile('10');
print_r($result);
```
